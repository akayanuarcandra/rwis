<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\IssueReportModel;
use Illuminate\Database\Eloquent\Builder;

class IssueReportTable extends DataTableComponent
{
    protected $model = IssueReportModel::class;

    public function builder(): Builder
    {
        return IssueReportModel::query()
            ->where('issue_report.is_archived', false);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('issue_report.created_at', 'desc');
        $this->setSearchFieldAttributes(['class' => 'rounded-lg border border-gray-300 p-2']);
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "issue_report_id")->hideIf(true),
            Column::make("Tanggal", "created_at")
                ->format(fn($value) => $value->timezone('Asia/Jakarta')->translatedFormat('H:i:s, l, d M Y'))
                ->sortable()
                ->searchable(),
            Column::make("Reporter", "resident.full_name")
                ->sortable()
                ->searchable(),
            Column::make("Number Phone", "resident.whatsapp_number")
                ->sortable()
                ->searchable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Status", "status")
                ->sortable()
                ->searchable(),
            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $show = '<button class="show-btn text-white font-bold p-2 rounded" wire:click="show(' . $row->issue_report_id . ')">Show</button>';
                        $archive = '<button class="archive-btn text-white font-bold p-2 rounded" onclick="document.getElementById(\'my_modal_' . $row->issue_report_id . '\').showModal()">Archive</button>
                        <dialog id="my_modal_' . $row->issue_report_id . '" class="modal">
                          <div class="modal-box rounded-md shadow-xl">
                            <h3 class="font-bold text-lg mt-2 ml-2">Alert!</h3>
                            <p class="py-4 mt-2 ml-2">Are you sure to archive this data?</p>
                            <div class="modal-action">
                              <form method="dialog">
                                <!-- if there is a button in form, it will close the modal -->
                                <button class="archive-btn text-white font-bold p-2 m-1 rounded" wire:click="archive(' . $row->issue_report_id . ')">Archive</button>
                                <button class="add-btn text-white font-bold p-2 mx-2 mb-2 m-1 rounded">Close</button>
                              </form>
                            </div>
                          </div>
                        </dialog>';
                        return '<div class="flex items-center gap-2">' . $show . $archive . '</div>';
                    }
                )->html(),
        ];
    }

    public function show($householdId)
    {
        return redirect()->route('issue-report.show', $householdId);
    }

    public function archive($id)
    {
        $resident = IssueReportModel::find($id);
        $resident->is_archived = true;
        $resident->save();
        redirect('/issue/approval');
    }
}
