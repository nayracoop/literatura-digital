<?php
use Illuminate\Cookie\CookieJar;

namespace App\Utils;

/**
* UserHistory ayuda a manejar el array de historial
*
*/

class UserHistory
{
    private $history;

    public function __construct($history)
    {
        $this->history = $history;
    }

    /**
    *
    */
    public static function addStory($target, $story, $source, $cookieJar = null)
    {
        $history = null;
        //print_r($source->cookie('history'));
        if ($target == 'user') {
            $source->history = self::addStoryProcess($story, $source->history);
            $source->save();
        } elseif ($target == 'cookie') {
            $history = self::addStoryProcess($story, $source->cookie('history'));
            $cookieJar->queue(cookie('history', $history, 45000));
            //var_dump(json_encode($history, JSON_PRETTY_PRINT));
        }
    }

    public static function addStoryProcess($story, $history)
    {
        if (isset($history['stories'][$story->_id])) {
              $history['stories'][$story->_id]['views']++;
        } else { //nuevo relato
              $history['stories'][$story->_id]['textNodes'] =  null;
              $history['stories'][$story->_id] ['views'] = 1;
        }
        return $history;
    }

    /**
    *
    */
    public static function addNode($target, $textNode, $source, $cookieJar = null)
    {
        $history = null;
        //print_r($textNode);
        if ($target == 'user') {
            $source->history = self::addNodeProcess($textNode, $source->history);
            $source->save();
        } elseif ($target == 'cookie') {
            $history = self::addNodeProcess($textNode, $source->cookie('history'));
            $cookieJar->queue(cookie('history', $history, 45000));
        }
    }

    /**
    *
    */
    public static function addNodeProcess($textNode, $history)
    {

        $story = $textNode->story;
      //  var_dump($textNode);
        if (!isset($history['stories'][$story->id])) {
            $history = self::addStoryProcess($story, $history);
        }

        if (isset($history['stories'][$story->_id]['textNodes'][$textNode->id])) {
            $history['stories'][$story->_id]['textNodes'][$textNode->id]['views'] ++;
        } else { //nuevo relato
            $history['stories'][$story->_id]['textNodes'][$textNode->id]['views'] =   1;
        }

        return $history;
    }


    /**
    *  Busca si la historia fue leida
    */
    public function isReadStory($id)
    {
        $isRead = false;
        foreach ($this->history['stories'] as $key => $value) {
            if ($key == $id) {
                $isRead = true;
                break;
            }
        }
        return $isRead;
    }

    /**
    *  Busca si el nodo/fragmento fue leido
    */
    public function isReadNode($story, $id)
    {
        $isRead = false;
        if (isset($this->history['stories'][$story]['textNodes'])) {
            foreach ($this->history['stories'][$story]['textNodes'] as $key => $value) {
                if ($key == $id) {
                    $isRead = true;
                    break;
                }
            }
        }
        return $isRead;
    }
}
