<?php

namespace App\Console\Commands;

use App\Entities\Line;
use App\Entities\Occurrence;
use App\Entities\Status;
use App\Repositories\LineRepository;
use App\Repositories\StatusRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

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

        $data = new Collection(json_decode($json, true));

        $data->map(function ($item) {
            $this->iterate($item);
        });

        $this->manager->flush();

        $this->line(Carbon::now()->toDateTimeString());
    }

    public function iterate($item)
    {
        $line = $this->lineRepository->find($item['LinhaId']);

        $actualStatus = $this->statusRepository->firstOrCreate(['name' => $item['Status']]);

        if ($line->getOccurrences()->count() === 0) {
            $this->startOccurrence($item['Descricao'], $actualStatus, $line, $item['DataGeracao']);

            return;
        }

        $lastOccurrence = $line->getOccurrences()->last();

        $lastStatus = $lastOccurrence->getStatus();

        $statusChanged = $actualStatus->getName() !== $lastStatus->getName();

        $descriptionChanged = $lastOccurrence->getDescription() !== $item['Descricao'];

        $emptyOccurrences = is_null($lastOccurrence);

        if ($statusChanged || $descriptionChanged) {
            $this->finishOccurrence($lastOccurrence, $item['DataGeracao']);
        }

        if ($statusChanged || $descriptionChanged || $emptyOccurrences) {
            $this->startOccurrence($item['Descricao'], $actualStatus, $line, $item['DataGeracao']);
        }
    }

    public function finishOccurrence(Occurrence $occurrence, string $finishedAt)
    {
        $occurrence->setFinishedAt($finishedAt);

        $this->manager->persist($occurrence);
    }

    public function startOccurrence(string $description, Status $status, Line $line, string $startedAt)
    {
        $occurrence = new Occurrence();

        $occurrence->setDescription($description);
        $occurrence->setStatus($status);
        $occurrence->setLine($line);
        $occurrence->setStartedAt($startedAt);

        $this->manager->persist($occurrence);
    }
}
