<?php

namespace App\Http\Livewire;

use App\Http\Traits\GenereteNumberTrait;
use App\Models\RankList;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Game extends Component
{
    use GenereteNumberTrait;

    const SECRET_LENGTH = 4;

    public bool $start = false;
    public ?Carbon $startTime = null;
    public int $attempts = 0;
    public int $bulls = 0;
    public int $cows = 0;
    public bool $win = false;
    public string $nickname = '';
    public int $totalDuration = 0;
    public $rankList;

    public array $number = [];
    public ?string $number1 = null;
    public ?string $number2 = null;
    public ?string $number3 = null;
    public ?string $number4 = null;

    /**
     * Livewire click event: Start the game
     */
    public function startGame(): void
    {
        $this->validate([
            'nickname' => 'required|min:1',
        ]);

        $this->start = true;
        $this->win = false;
        $this->totalDuration = $this->cows = $this->bulls = $this->attempts = 0;
        $this->startTime = now();

        Session::put('secret', $this->getSecretNumber(self::SECRET_LENGTH));

        $this->number = [];
        $this->number1 = $this->number2 = $this->number3 = $this->number4 = null;
    }

    /**
     * Livewire change event: change value
     */
    public function setNumber($index, $value): void
    {
        $this->number[$index] = $this->{'number' . $index};

        // exclude own
        $number = $this->number;
        unset($number[$index]);

        $this->validate([
            'number' . $index => 'nullable|integer|gte:1|lte:9|not_in:' . implode(',', $number),
        ]);

        $this->number[$index] = $this->{'number' . $index};

        if (count($this->number) == self::SECRET_LENGTH) {
            $this->countCowsAndBulls();
        }
    }

    /**
     * Counts bulls and cows and check for win
     */
    private function countCowsAndBulls()
    {
        $this->attempts++;
        $this->cows = 0;
        $this->bulls = 0;
        $secret = Session::get('secret');

        info($secret);

        foreach ($this->number as $k => $value) {
            $char = substr($secret, $k - 1, 1);

            if ($value == $char) {
                $this->bulls++;

                if ($this->bulls == self::SECRET_LENGTH) {
                    $this->win();
                }
            } else if (in_array($char, $this->number)) {
                $this->cows++;
            }
        }
    }

    /**
     * Store the win in DB
     */
    private function win(): void
    {
        $this->win = true;
        $this->totalDuration = now()->diffInSeconds($this->startTime);

        $this->validate([
            'nickname'      => 'required|min:1',
            'attempts'      => 'required|integer',
            'totalDuration' => 'required|integer',
        ]);

        RankList::Create([
            'nickname' => $this->nickname,
            'attempts' => $this->attempts,
            'time'     => $this->totalDuration
        ]);

        $this->updateRanklist();
    }

    /**
     * Init livewire function
     */
    public function mount(): void
    {
        $this->updateRanklist();
    }

    private function updateRanklist(): void
    {
        $this->rankList = RankList::orderBy('attempts', 'asc')
        ->orderBy('time', 'asc')
        ->limit(10)
        ->get();
    }

    /**
     * Render view
     */
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.game');
    }
}
