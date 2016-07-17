<?php

namespace Drupal\ww_angularjs_drupal8\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\user\Entity\User;
use Drupal\taxonomy\Entity\Term;
use Drupal\Component\Utility\Unicode;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Drupal\image\Entity\ImageStyle;

/**
 * Class wwAngularjsDrupal8Controller.
 *
 * @package Drupal\ww_angularjs_drupal8\Controller
 */
class wwAngularjsDrupal8Controller extends ControllerBase {

  /**
   * wwAngularjsDrupal8.
   *
   * @return Name Search Page.
   */
   public function wwAngularjsDrupal8() {
    $node_query = \Drupal::entityQuery('node');
    $query = $node_query->condition('status', 1)
        ->condition('type', 'name')
        ->sort('title', 'ASC');
    $name_ids = array_values($query->execute());
    $number = 0;
    $names = array();
    foreach($name_ids as $nid){
      $name = Node::load($nid);
      $names[$number]['title'] = $name->title->value;
      $number ++;
    }

    /***** Return *****/
    return [
      '#theme' => 'block_ww_angularjs_drupal8_twig',
      '#title_page' => $this->t('Names'),
      '#names' => $names,
      '#card_title' => $this->t('HELLO'),
      '#card_subtitle' => $this->t('my name is...'),
      '#placeholder' => $this->t('Name'),
      '#submit' => $this->t('Search'),
      '#error' => $this->t('Sorry, the name is not in our database yet.'),
      '#attached' => [
        'library' => [
          'ww_angularjs_drupal8/ww_angularjs_drupal8'
        ]
      ]
    ];
   }
}
