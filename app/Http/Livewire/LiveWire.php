<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

Abstract class LiveWire extends Component
{
    use LivewireAlert, WithFileUploads;

    public function validate($rules = null, $messages = [], $attributes = [],$callBackFunctionFails = null)
    {

        [$rules, $messages, $attributes] = $this->providedOrGlobalRulesMessagesAndAttributes($rules, $messages, $attributes);

        $data = $this->prepareForValidation(
            $this->getDataForValidation($rules)
        );

        $this->checkRuleMatchesProperty($rules, $data);

        $ruleKeysToShorten = $this->getModelAttributeRuleKeysToShorten($data, $rules);

        $data = $this->unwrapDataForValidation($data);

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($this->withValidatorCallback) {
            call_user_func($this->withValidatorCallback, $validator);

            $this->withValidatorCallback = null;
        }

        $this->shortenModelAttributesInsideValidator($ruleKeysToShorten, $validator);

        $customValues = $this->getValidationCustomValues();
        if (!empty($customValues)) {
            $validator->addCustomValues($customValues);
        }

        if($validator->fails()){
            if(isset($callBackFunctionFails)){
                call_user_func($callBackFunctionFails);
            }else{
                $this->alert('error','Validation Failed CHeck yOUR Inputs');
            }
        }

        $validatedData = $validator->validate();

        $this->resetErrorBag();

        return $validatedData;
    }

}
