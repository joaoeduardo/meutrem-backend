<?php

use App\Repositories\CompanyRepository;
use App\Repositories\LineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     *
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * @var LineRepository
     */
    private $lineRepository;

    public function __construct()
    {
        $this->manager = app(EntityManagerInterface::class);

        $this->companyRepository = app(CompanyRepository::class);

        $this->lineRepository = app(LineRepository::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metro = $this->companyRepository->firstOrNew(['name' => 'Metrô', 'slug' => 'M']);

        $this->manager->persist($metro);

        $cptm = $this->companyRepository->firstOrNew(['name' => 'CPTM', 'slug' => 'C']);

        $this->manager->persist($cptm);

        $viaQuatro = $this->companyRepository->firstOrNew(['name' => 'ViaQuatro', 'slug' => '4']);

        $this->manager->persist($viaQuatro);

        $line = $this->lineRepository->firstOrNew(['id' => 1, 'name' => 'Azul', 'color' => '#195BA2']);

        $line->setCompany($metro);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 2, 'name' => 'Verde', 'color' => '#008468']);

        $line->setCompany($metro);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 3, 'name' => 'Vermelha', 'color' => '#EF4B43']);

        $line->setCompany($metro);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 4, 'name' => 'Amarela', 'color' => '#FFD525']);

        $line->setCompany($viaQuatro);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 5, 'name' => 'Lilás', 'color' => '#A74E9C']);

        $line->setCompany($metro);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 7, 'name' => 'Rubi', 'color' => '#A2306C']);

        $line->setCompany($cptm);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 8, 'name' => 'Diamante', 'color' => '#A0A097']);

        $line->setCompany($cptm);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 9, 'name' => 'Esmeralda', 'color' => '#00AA91']);

        $line->setCompany($cptm);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 10, 'name' => 'Turquesa', 'color' => '#008092']);

        $line->setCompany($cptm);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 11, 'name' => 'Coral', 'color' => '#F05736']);

        $line->setCompany($cptm);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 12, 'name' => 'Safira', 'color' => '#284B8C']);

        $line->setCompany($cptm);

        $this->manager->persist($line);

        $line = $this->lineRepository->firstOrNew(['id' => 15, 'name' => 'Prata', 'color' => '#899093']);

        $line->setCompany($metro);

        $this->manager->persist($line);

        $this->manager->flush();
    }
}
