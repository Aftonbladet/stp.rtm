<?php
/**
 * Calls url specified in widget configuration and return number from it.
 * Endpoint specified by url must return data in json format.
 * Value can be resolved straight from the response or from response json object property with name specified in widget configuration
 * (configuration property name: "numberProperty").
 * Currently Number and Error widgets are supported.
 *
 * @author: Wojciech Niemiec
 */

namespace Dashboard\Model\Dao;

use Zend\Http\Response;

class NumberHttpDao extends AbstractDao {

    function fetchThreshold(array $params = array()) {
        $threshold = array(
            'caution-value' => array_key_exists('cautionValue', $params) ? $params['cautionValue'] : 300,
            'critical-value' => array_key_exists('criticalValue', $params) ? $params['criticalValue'] : 400
        );

        return $threshold;
    }

    function fetchNumberForNumberWidget(array $params = array()) {
        return $this->doFetchNumber($params);
    }

    function fetchNumberForErrorWidget(array $params = array()) {
        return $this->doFetchNumber($params);
    }

    function doFetchNumber(array $params = array()) {
        $response = $this->request($params['url'], $params);
        if (array_key_exists('numberProperty', $params)) {
            return $response[$params['numberProperty']];
        }

        return $response;
    }
}