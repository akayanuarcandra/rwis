<?php

namespace App\Livewire;

use App\Models\HouseholdModel;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SocialAidResidentTable extends DataTableComponent
{
    protected $model = HouseholdModel::class;
    protected LengthAwarePaginator $rows;

    public function mount(LengthAwarePaginator $rows): void
    {
        $this->rows = $rows;
    }

    public function getRows(): Collection|CursorPaginator|Paginator|LengthAwarePaginator
    {
        return $this->rows;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('household_id');
        $this->setSearchFieldAttributes([
            'class' => 'rounded-lg border border-gray-300 p-2',
        ]);
        $this->setSearchDisabled();
        $this->setPaginationDisabled();
        $this->setColumnSelectDisabled();
    }

    public function columns(): array
    {
        // when we pass the rows manually, for some reason it can't get the relationship correctly
        // so we need to manually format the column to workaround that
        return [
            Column::make("ID", "household_id")
                ->hideIf(true),
            Column::make("Nama Lengkap", "familyHead")
                ->format(fn($value, HouseholdModel $model) => $model->familyHead->full_name),
            Column::make("KK", "number_kk"),
            Column::make("Alamat", "address"),
            Column::make("Nomor Telepon", "familyHead.whatsapp_number")
                ->format(fn($value, HouseholdModel $model) => $model->familyHead->whatsapp_number),
            Column::make('Aksi')
                ->label(fn($row, Column $column) => view('components.column-action', ['id' => $row->household_id, 'menu' => ['show']]))
                ->html(),
        ];
    }

    public function show(string $householdId)
    {
        return redirect()->route('data.household.show', $householdId);
    }
}
