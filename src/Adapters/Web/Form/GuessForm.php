<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\Web\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuessForm extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['number_of_pegs']);
    }
}
