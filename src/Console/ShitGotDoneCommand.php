<?php
declare(strict_types=1);

namespace Denitsa\ShitGotDone\Console;

use Denitsa\ShitGotDone\StoryDTO;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;

class ShitGotDoneCommand extends Command
{
    private string $clubhouseOwner;
    private string $clubhouseUrl;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'got-shit-done
    {--this-week}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'What stuff did I do last day/week/month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->clubhouseOwner = config('shit-got-done.clubhouse_user');
        $this->clubhouseUrl = 'https://api.clubhouse.io/api/v3/search/stories?token=' . config('shit-got-done.clubhouse_token') . '&';
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = new Table($this->output);

        if ($this->option('this-week')) {
           $stories = array_merge($this->currentlyInDevelopment(), $this->readyForReviewThisWeek(), $this->completedThisWeek());
        }

        $table->setHeaders(['Type', 'Name', 'State', 'Completed']);

        $tableData = [];
        $separator = new TableSeparator();
        foreach ($stories as $story) {
            array_push($tableData, [
                $story->type, $story->name, $story->state, $story->completedAt
            ], $separator);
        }

        array_pop($tableData);
        $table->setRows($tableData);
        $table->render();
        return true;
    }

    private function currentlyInDevelopment() {
           $query = Arr::query([
                'page_size' => 25,
                'query' => "state:\"in development\" !is:archived owner:$this->clubhouseOwner"
           ]);

            $response = Http::get($this->clubhouseUrl . $query)->json();

            return array_map(fn($story) => StoryDTO::fromResponse($story, 'in development'), $response['data']);
    }

    private function readyForReviewThisWeek() {
           $query = Arr::query([
                'page_size' => 25,
                'query' => "state:\"ready for review\" !is:archived owner:$this->clubhouseOwner"
           ]);

            $response = Http::get($this->clubhouseUrl . $query)->json();

            return array_map(fn($story) => StoryDTO::fromResponse($story, 'ready for review'), $response['data']);
    }

     private function completedThisWeek() {
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');

           $query = Arr::query([
                'page_size' => 25,
                'query' => "is:done moved:{$startOfWeek}..{$endOfWeek} !is:archived owner:$this->clubhouseOwner"
           ]);

            $response = Http::get($this->clubhouseUrl . $query)->json();

            return array_map(fn($story) => StoryDTO::fromResponse($story, 'complete'), $response['data']);
    }
}
