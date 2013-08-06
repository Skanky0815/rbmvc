<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 17:24
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\View\Helper;

class Button extends HasAccess {

    /**
     * @param string|array $options
     * @param int $id
     *
     * @return mixed|null|string
     */
    public function button($options, $id = null) {
        if (is_string($options)) {
            $button = null;
            switch ($options) {
                case 'add':
                    $button = $this->add();
                    break;
                case 'edit':
                    $button = $this->edit($id);
                    break;
                case 'delete':
                    $button = $this->delete($id);
                    break;
            }

            return $button;
        }

        if (!$this->hasAccess($options['url'])) {
            return '';
        }

        return $this->view->partial('layout/partials/button.phtml', $options);
    }

    /**
     * @return null|string
     */
    private function  add() {
        return $this->button(array(
                                  'url'   => $this->view->url(array('action' => 'add')),
                                  'icon'  => 'icon-plus',
                                  'class' => 'btn-primary',
                                  'label' => 'add',
                             ));
    }

    /**
     * @param int $id
     *
     * @return null|string
     */
    private function edit($id) {
        return $this->button(array(
                                  'url'   => $this->view->url(array('action' => 'edit', 'id' => $id), true),
                                  'icon'  => 'icon-edit',
                                  'class' => 'btn-default',
                                  'label' => 'edit',
                             ));
    }

    /**
     * @param int $id
     *
     * @return null|string
     */
    private function delete($id) {
        return $this->button(array(
                                  'url'   => $this->view->url(array('action' => 'delete', 'id' => $id), true),
                                  'icon'  => 'icon-trash',
                                  'class' => 'btn-danger delete',
                                  'label' => 'delete',
                             ));
    }
}