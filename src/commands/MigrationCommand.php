<?php namespace iWedmak\UrlAuth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
class MigrationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'urlauth:migration';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration following the UrlAuth specifications.';
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->laravel->view->addNamespace('urlauth', substr(__DIR__, 0, -8).'views');
        $logTable = Config::get('urlauth.table');
        $this->line('');
        $this->info( "Table: $logTable" );
        $message = "A migration that creates '$logTable'".
        " table will be created in database/migrations directory";
        $this->comment($message);
        $this->line('');
        if ($this->confirm("Proceed with the migration creation? [Yes|no]", "Yes")) {
            $this->line('');
            $this->info("Creating migration...");
            if ($this->createMigration($logTable)) {
                $this->info("Migration successfully created!");
            } else {
                $this->error(
                    "Couldn't create migration.\n Check the write permissions".
                    " within the database/migrations directory."
                );
            }
            $this->line('');
        }
    }
    /**
     * Create the migration.
     *
     * @param string $name
     *
     * @return bool
     */
    protected function createMigration($logTable)
    {
        $migrationFile = base_path("/database/migrations")."/".date('Y_m_d_His')."_urlauth_setup_tables.php";
        $output = $this->laravel->view->make('urlauth::generators.migration')->with(['logTable'=>$logTable])->render();
        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            return true;
        }
        return false;
    }
}
