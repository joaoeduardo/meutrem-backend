<?php

namespace App\Console\Commands;

use App\Entities\Occurrence;
use App\Repositories\LineRepository;
use App\Repositories\StatusRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Console\Command;

class SyncCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Command';

    /**
     *
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     *
     * @var LineRepository
     */
    private $lineRepository;

    /**
     *
     * @var StatusRepository
     */
    private $statusRepository;

    /**
     * @param EntityManagerInterface $manager
     * @param LineRepository $lineRepository
     * @param StatusRepository $statusRepository
     */
    public function __construct(EntityManagerInterface $manager, LineRepository $lineRepository, StatusRepository $statusRepository)
    {
        parent::__construct();

        $this->manager = $manager;

        $this->lineRepository = $lineRepository;

        $this->statusRepository = $statusRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $json = file_get_contents(env('CPTM_API'));

        $data = json_decode($json, true);

        foreach ($data as $item) {
            $line = $this->lineRepository->find($item['LinhaId']);

            $actualStatus = $this->statusRepository->firstOrCreate(['name' => $item['Status']]);

            if ($line->getOccurrences()->count() == 0) {

                $occurrence = new Occurrence();

                $occurrence->setDescription($item['Descricao']);
                $occurrence->setStatus($actualStatus);
                $occurrence->setLine($line);
                $occurrence->setStartedAt($item['DataGeracao']);

                $this->manager->persist($occurrence);
            } else {
                if ($line->getOccurrences()->last()->getDescription() != $item['Descricao']) {
                    $line->getOccurrences()->last()->setFinishedAt($item['DataGeracao']);

                    $this->manager->persist($line);

                    $occurrence = new Occurrence();

                    $occurrence->setDescription($item['Descricao']);
                    $occurrence->setStatus($actualStatus);
                    $occurrence->setLine($line);
                    $occurrence->setStartedAt($item['DataGeracao']);

                    $this->manager->persist($occurrence);
                }
            }
        }

        $this->manager->flush();

        $this->line(Carbon::now()->toDateTimeString());
    }
}
