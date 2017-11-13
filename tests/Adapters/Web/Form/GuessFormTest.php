<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\Web\Form;

use Symfony\Component\Form\Test\TypeTestCase;
use SymfonyCon\Mastermind\Game\Code;

class GuessFormTest extends TypeTestCase
{
    public function test_submit_creates_code()
    {
        $formData = [
            'guess' => [
                'peg_1' => 'Red',
                'peg_2' => 'Green',
                'peg_3' => 'Yellow',
                'peg_4' => 'Blue',
            ],
        ];

        $form = $this->factory->create(GuessForm::class, null, ['number_of_pegs' => 4]);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals(Code::fromColours($formData['guess']), $form->getData());
    }
}
