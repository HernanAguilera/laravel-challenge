<?php

namespace App\Console\Commands;

use App\Services\LoadDataService;
use Illuminate\Console\Command;

class LoadEntitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:entities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Carga datos de la categoría Animals y Security desde el archivo JSON';

    protected LoadDataService $loadDataService;

    public function __construct(LoadDataService $loadDataService)
    {
        parent::__construct();
        $this->loadDataService = $loadDataService;
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->loadDataService->fetchAndStoreEntities('Animals');
            $this->info('Datos de la categoría Animals cargados exitosamente.');
        } catch (\Exception $e) {
            $this->error('Error al cargar datos de la categoría Animals');
            $this->error($e->getMessage());
        }
        try {
            $this->loadDataService->fetchAndStoreEntities('Security');
            $this->info('Datos de la categoría Security cargados exitosamente.');
        } catch (\Exception $e) {
            $this->error('Error al cargar datos de la categoría Security cargados exitosamente.');
            $this->error($e->getMessage());
        }
    }
}
