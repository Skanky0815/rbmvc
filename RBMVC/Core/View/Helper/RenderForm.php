<?php
namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Modifiers\String\GetClassNameWithUnderscore;

/**
 * Class RenderForm
 * @package RBMVC\Core\View\Helper
 */
class RenderForm extends AbstractViewHelper {

    /**
     * @param Form $form
     *
     * @return string
     */
    public function renderForm(Form $form) {
        $elementTemplates = array();
        foreach ($form->getElements() as $name => $element) {
            $converter               = new GetClassNameWithUnderscore();
            $className               = $converter->getClassName($element);
            $elementTemplates[$name] =
                $this->view->partial('form/element/' . $className . '.phtml', array('element' => $element));
        }

        return $this->view->partial('form/form.phtml',
            array('form'    => $form,
                  'element' => $elementTemplates
            )
        );
    }
}