<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.10.13
 * Time: 10:20
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

/**
 * Class SingleLink
 * @package RBMVC\Core\Utilities\Form\Decorators\Element
 */
class SingleLink extends AbstractDecorator {

    /**
     * @var string
     */
    private $htmlLink = '<a id="%s" target="%s" href="%s" title="%s" class="btn %s">%s</a>';

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        /** @var \RBMVC\Core\Utilities\Form\Elements\Link $element */
        $element = $this->element;

        return sprintf($this->htmlLink, $element->getName(), $element->getTarget(), $element->getUrl(),
            $this->translator->translate($element->getName()), $element->getType(),
            $this->translator->translate($element->getName()));
    }

}