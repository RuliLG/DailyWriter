<?php

namespace App\Http\Controllers;

use App\Actions\Writing\StoreWriting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WriteController extends Controller
{
    public function render(string $date, Request $request)
    {
        $date = Carbon::createFromFormat('Ymd', $date);
        $write = $request->user()->writings()->whereDate('date', $date)->first();
        $daysInMonth = [];
        $firstDay = $date->copy()->startOfMonth();
        for ($i = 0; $i < $date->daysInMonth; $i += 1) {
            $daysInMonth[] = $firstDay->copy()->addDays($i)->format('Y-m-d');
        }
        $monthlyWritings = $request->user()
            ->writings()
            ->select('date', 'word_count')
            ->whereMonth('date', $date->month)
            ->get()
            ->keyBy(fn ($item) => $item->date->format('Y-m-d'));
        return Inertia::render('Write', [
            'raw_date' => $date->format('Ymd'),
            'month' => $date->format('Y-m'),
            'date' => $date->format('Y-m-d'),
            'days_in_month' => $daysInMonth,
            'write' => $write,
            'monthly_writings' => $monthlyWritings,
        ]);
    }

    public function store(string $date, Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        $date = Carbon::createFromFormat('Ymd', $date);
        StoreWriting::run($validated['content'], $date->format('Y-m-d'), $request->user());
        return $this->render($date->format('Ymd'), $request);
    }
}
