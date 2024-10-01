<?php

namespace Modules\Core\Traits;

use Modules\Core\Contracts\WizardForm;

trait BelongsToLivewire
{
    protected WizardForm $livewire;

    public function setLivewire(WizardForm $livewire)
    {
        $this->livewire = $livewire;

        return $this;
    }

    public function getLivewire(): WizardForm
    {
        return $this->livewire;
    }
}
