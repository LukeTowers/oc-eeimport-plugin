<?php namespace LukeTowers\EEImport\Console;

use Illuminate\Console\Command;

use LukeTowers\EEImport\Models\Category;
use LukeTowers\EEImport\Models\CategoryGroup;
use LukeTowers\EEImport\Models\Channel;
use LukeTowers\EEImport\Models\Comment;
use LukeTowers\EEImport\Models\Entry;
use LukeTowers\EEImport\Models\EntryData;
use LukeTowers\EEImport\Models\EntryField;
use LukeTowers\EEImport\Models\Member;
use LukeTowers\EEImport\Models\MemberData;
use LukeTowers\EEImport\Models\MemberField;
use LukeTowers\EEImport\Models\MemberGroup;

class Import extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'expressionengine:import';

    /**
     * @var string The console command description.
     */
    protected $description = 'Example EE Import command';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        // Get the members sorted by most entries posted
        // dd(Member::withCount('entries')->orderBy('entries_count', 'desc')->pluck('entries_count', 'member_id'));

        // Get all entries from the articles channel
        // Channel::fromName('articles')->entries;

        // Get all registered Members
        // Member::all()

        // Get all stored comments
        // Comment::all()

        // Get all comments for the first article
        // $entry = Channel::fromName('articles')->entries()->first()
        // $comments = $entry->comments

        // Get the author of a particular article
        // $author = $entry->member
    }
}
