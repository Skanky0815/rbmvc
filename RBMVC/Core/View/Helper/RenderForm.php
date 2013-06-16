<?php
namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Utilities\Form\Form;

class RenderForm extends AbstractHelper {
    
    /**
     * @param \RBMVC\Core\Utilities\Form\Form $form
     * @return string
     */
    public function renderForm(Form $form) {
        $elementTemplates = array();
        foreach ($form->getElements() as $name => $element) {
            $this->view->element = $element;
            $elementTemplates[$name] = $this->view->render('template/form/elements/input-element.phtml');
        }
        $this->view->elements = $elementTemplates;
        return $this->view->render('template/form/form.phtml');
    }
}