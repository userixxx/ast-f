<?php

namespace App\Http\Livewire\Specialist\Report;

use App\Models\Farm;
use App\Models\FieldCategory;
use App\Models\Form;
use App\Models\FormField;
use App\Models\Organization;
use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateReport extends Component
{
    public Form|Collection $forms;
    public Organization|Collection $organisations;
    public Farm|Collection $farms;
    public $selectedForm = 0;
    public $selectedOrganisation;
    public $selectedOrganisation1;
    public $selectedFarm;

    public $organisationId = 0;
    public $farmId = 0;
    public $farmUuid = '';
    public $formId = 0;
    /**
     * @var true
     */
    public bool $readyToSave = false;
    public FormField|Collection $formFields;
    public FormField|Collection $formFieldsGroupedByCategory;
    /**
     * @var \Illuminate\Database\Eloquent\Builder[]|Collection
     */
    public array|Collection $formFieldsCategories;
    /**
     * @var string[]
     */
    public array $colors;
    public  $lastReportData = [];

    public function __construct($id = null)
    {

        parent::__construct($id);
        $this->organisations = Organization::all();
        $this->farms = Farm::where('organization_id', $this->organisationId)->get();
        $this->forms = Form::all();
        $this->formFields = FormField::where('form_id', $this->selectedForm)->get();
        $this->formFieldsCategories = FieldCategory::where('id',0)->get();
        $this->colors = FieldCategory::CATEGORY_COLORS;
    }

    public function updatedSelectedOrganisation()
    {
        $organisation = Organization::when($this->selectedOrganisation, function ($query) {
            return $query->where('name', $this->selectedOrganisation);
        })->first();

        if ($organisation) {
            $this->organisationId = $organisation->id;
        } else {
            $this->dropOrganisation();
        }
        $this->farms = Farm::where('organization_id', $this->organisationId)->get();
        $this->isReadyToSave();

    }

    public function updatedSelectedFarm()
    {
        $farm = Farm::when($this->selectedFarm, function ($query) {
            return $query->where('organization_id', $this->organisationId)->where('name', $this->selectedFarm);
        })->first();

        if ($farm) {
            $this->farmId = $farm->id;
            $this->farmUuid = $farm->uuid;
        } else {
            $this->dropFarm();
        }
        $this->isReadyToSave();

    }

    public function updatingSelectedForm()
    {
        if ($this->selectedForm) {
            $this->formId = $this->selectedForm;
        } else {
            $this->dropForm();
        }
        $this->isReadyToSave();
    }

    public function updatedSelectedForm()
    {
        $this->isReadyToSave();

        $this->formFieldsCategories = FieldCategory::with(['fields'=>function($query){
            $query->where('form_id', $this->selectedForm)->groupBy('id');
        }])->has('fields')->get();

    }

    public function dropOrganisation()
    {
        $this->organisationId = 0;
        $this->selectedFarm = '';
        $this->farmId = 0;
    }

    public function dropFarm()
    {
        $this->farmId = 0;
        $this->farmUuid = '';
    }

    public function dropForm()
    {
        $this->formId = 0;
    }

    public function updated()
    {
        $this->isReadyToSave();
        $this->loadFormFields();
    }

    public function isReadyToSave()
    {

        if ($this->organisationId && $this->farmId && $this->selectedForm) {
            $this->readyToSave = true;
        } else {
            $this->readyToSave = false;
        }
    }

    public function loadFormFields()
    {
        $this->formFields = FormField::where('form_id', $this->selectedForm)->get();
    }

    public function render()
    {
        return view('livewire.specialist.report.create-report');
    }


    public function fillFields()
    {
        $this->lastReportData = Report::where('farm_id', '=', $this->farmId)
            ->where('form_id', '=', $this->selectedForm)
            ->orderBy('updated_at', 'desc')
            ?->first()?->data ?? collect([]);
    }

}
