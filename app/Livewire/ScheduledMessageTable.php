<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ScheduledMessageModel;
use Illuminate\Database\Eloquent\Builder;

class ScheduledMessageTable extends DataTableComponent
{
    protected $model = ScheduledMessageModel::class;

    public function builder(): Builder
    {
        return ScheduledMessageModel::query()
            ->where('scheduled_message.is_archived', false);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setSearchFieldAttributes([
            'class' => 'rounded-lg border border-gray-300 p-2',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Broadcast template Message","broadcastTemplate.text")
                ->sortable()
                ->searchable(),
            Column::make("Sender", "sender.name")
                ->sortable()
                ->searchable(),
            Column::make("Receiver", "receiver.full_name")
                ->sortable(),
        ];
    }
}
