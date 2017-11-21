<?php

namespace Lib\Interfaces;

/**
 * Interface CacheInterface
 * @package Lib\Interfaces
 */
interface CacheInterface
{

    /**
     * setCreateCache  [description]
     * @param $cacheProvider
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function setCreateCache($cacheProvider);

    /**
     * createCache  [设置缓存驱动程序]
     * @param $params
     * @param string $default
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function createCache($params, $default = 'arrayCache');


    /**
     * get  [得到缓存]
     * @param $id 缓存ID
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function get($id = '');


    /**
     * set  [设置储存缓存数据 / 您可以保存任何类型的数据，无论是字符串，数组，对象等]
     * @param $id  缓存ID
     * @param $data 数据
     * @param string $lifeTime 则为此缓存条目设置特定的生命周期（null => infinite lifeTime）
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function set($id = '', $data, $lifeTime = '');


    /**
     * checking  [检查缓存ID]
     * @param $id 缓存的ID
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function checking($id = '');


    /**
     * delete  [删除缓存]
     * @param $id 缓存的ID
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function delete($id = '');


    /**
     * deleteAll  [删除所有的缓存]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function deleteAll();


    /**
     * setNamespace  [命名空间缓存]
     * 如果您在应用程序中大量使用缓存并将其用于应用程序的多个部分，
     * 或者在同一服务器上的不同应用程序中使用缓存，则缓存命名冲突可能会有问题。
     * 这可以通过使用命名空间解决。您可以通过使用setNamespace()方法来设置缓存驱动程序应该使用的名称空间 。
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function setNamespace($namespace);
}