<?php
/**
 * Devils Pinger DAO
 *
 * @author: Adam Łukaszczyk <adam.lukaszczyk@gmail.com>
 */

namespace Dashboard\Model\Dao;

class DevilsPingerDao extends AbstractDao {


    function fetchThreshold() {
        $threshold = array(
            'caution-value' => 1,
            'critical-value' => 1,
        );

        return $threshold;
    }

    function fetchErrorsNumberForNumberWidget(array $params = array()) {
        $data = $this->request($params['url'], $params);

        return $data['errors'];
    }

}