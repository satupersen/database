<?php

namespace Satupersen\Database\Console\Seeds;

use Satupersen\Console\Command;
use Satupersen\Console\ConfirmableTrait;
use Satupersen\Database\ConnectionResolverInterface as Resolver;
use Satupersen\Database\Eloquent\Model;
use Symfony\Component\Console\Input\InputOption;

class SeedCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with records';

    /**
     * The connection resolver instance.
     *
     * @var \Satupersen\Database\ConnectionResolverInterface
     */
    protected $resolver;

    /**
     * Create a new database seed command instance.
     *
     * @param  \Satupersen\Database\ConnectionResolverInterface  $resolver
     * @return void
     */
    public function __construct(Resolver $resolver)
    {
        parent::__construct();

        $this->resolver = $resolver;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (! $this->confirmToProceed()) {
            return 1;
        }

        $previousConnection = $this->resolver->getDefaultConnection();

        $this->resolver->setDefaultConnection($this->getDatabase());

        Model::unguarded(function () {
            $this->getSeeder()->__invoke();
        });

        if ($previousConnection) {
            $this->resolver->setDefaultConnection($previousConnection);
        }

        $this->info('Database seeding completed successfully.');

        return 0;
    }

    /**
     * Get a seeder instance from the container.
     *
     * @return \Satupersen\Database\Seeder
     */
    protected function getSeeder()
    {
        $class = $this->laravel->make($this->input->getOption('class'));

        return $class->setContainer($this->laravel)->setCommand($this);
    }

    /**
     * Get the name of the database connection to use.
     *
     * @return string
     */
    protected function getDatabase()
    {
        $database = $this->input->getOption('database');

        return $database ?: $this->laravel['config']['database.default'];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['class', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder', 'DatabaseSeeder'],

            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed'],

            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production'],
        ];
    }
}
