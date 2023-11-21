<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsLiveComponent('date', template: 'components/date.html.twig')]
final class DateComponent
{
    use DefaultActionTrait;
    use ComponentToolsTrait;

    #[LiveProp(writable: true, onUpdated: 'onDisplayAsFrenchUpdated')]
    public bool $displayAsFrench = false;

    #[LiveProp]
    public ?string $date = null;

    #[PostMount]
    public function postMount(): array
    {
        $this->reloadDate();

        return [];
    }

    public function onDisplayAsFrenchUpdated($previousValue): void
    {
        // $this->query already contains a new value
        // and its previous value is passed as an argument
        $this->reloadDate();
        dump($this->date);
        $this->dispatchBrowserEvent('refresh:date');
    }

    public function reloadDate(): void
    {
        $date = new \DateTime();

        if($this->displayAsFrench)
        {
            $this->date = $date->format('d/m/Y H:i:s');
        } else {
            $this->date = $date->format('Y-m-d H:i:s');
        }
    }
}
