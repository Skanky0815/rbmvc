<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 10.11.13
 * Time: 20:32
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

/**
 * Class Assign
 * @package RBMVC\Core\Utilities\Form\Decorators\Element
 */
class Assign extends AbstractDecorator {

    /**
     * @var string
     */
    private $labelHtml = '<label class="col-lg-2 control-label" for="%s">%s%s</label>';

    /**
     * @var string
     */
    private $assignHtml = '<div class="col-10"><div class="row">%s%s</div></div>';

    /**
     * @var string
     */
    private $unassignedHtml = '<div class="col-6"><div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title"><i class="icon-search searchTrigger" data-target="unassigned-%s"></i>%s</h3></div><div class="panel-body"><ul class="list-group unassigned-%s">%s</ul></div></div></div>';

    /**
     * @var string
     */
    private $assignedHtml = '<div class="col-6">
                            <div class="panel panel-primary">
                            <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon-search searchTrigger" data-target="assigned-%s"></i>%s</h3>
                            </div>
                            <div class="panel-body">
                            <ul class="list-group assigned-%s">%s</ul>
                            </div>
                            </div>
                            </div>';

    /**
     * @var string
     */
    private $itemHtml = '<li class="list-group-item" data-value="%s"><i class="icon-move"></i> %s</li>';

    /**
     * @var string
     */
    private $errorHtml = '<span class="help-inline">%s</span>';

    /**
     * @var string
     */
    private $formGroup = '<div data-js="helper/assign" data-name="%s" data-unassign=".unassigned-%s" data-assign=".assigned-%s" class="form-group%s">%s%s%s</div>';

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        /** @var \RBMVC\Core\Utilities\Form\Elements\Assign $element */
        $element = $this->getElement();

        $label = '';
        if ($element->getLabel() != '') {
            $label = sprintf($this->labelHtml, $element->getName(),
                $this->translator->translate($element->getLabel()), ($element->isRequired() ? '*' : ''));
        }

        $unassignedItems = $element->getUnAssigned();
        /** @var AssignItem[] $assignedItems */
        $assignedItems = $element->getValue();
        if (!empty($assignedItems) && is_array($assignedItems)) {
            foreach ($assignedItems as $assigned) {
                if (array_key_exists($assigned->getValue(), $unassignedItems)) {
                    unset($unassignedItems[$assigned->getValue()]);
                }
            }
        } else {
            $assignedItems = array();
        }

        $assignedHtml   = $this->buildList($assignedItems, 'assigned', $this->assignedHtml);
        $unassignedHtml = $this->buildList($unassignedItems, 'unassigned', $this->unassignedHtml);

        $assign = sprintf($this->assignHtml, $assignedHtml, $unassignedHtml);

        $error = '';
        if ($element->hasError()) {
            $error = sprintf($this->errorHtml, [$this->translator->translate($element->getErrorText())]);
        }

        return sprintf($this->formGroup, $element->getName(), $element->getName(), $element->getName(),
            ($element->hasError() ? ' has-error' : ''), $label, $assign, $error);
    }

    /**
     * @param AssignItem[] $items
     * @param string $type
     * @param string $template
     *
     * @return string
     */
    private function buildList(array $items, $type, $template) {
        $html = '';
        foreach ($items as $item) {
            $html .= sprintf($this->itemHtml, $item->getValue(), $item->getTitle());
        }

        return sprintf($template, $this->element->getName(), $type, $this->element->getName(), $html);
    }

}