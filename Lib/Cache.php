<?php

namespace Lib;

use Doctrine\Common\Cache\ApcCache AS Apc;
use Doctrine\Common\Cache\ApcuCache AS Apcu;
use Doctrine\Common\Cache\MemcachedCache AS MemcachedCache;
use Doctrine\Common\Cache\MemcacheCache AS MemcacheCache;
use Doctrine\Common\Cache\RedisCache AS Redis;
use Doctrine\Common\Cache\XcacheCache AS X;
use Doctrine\Common\Cache\ArrayCache AS arr;

class Cache implements Interfaces\CacheInterface
{

    private $cacheDriver;

    private $parameters = [];


    /**
     * setCreateCache  [description]
     * @param $cacheProvider
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function setCreateCache($cacheProvider)
    {
        // TODO: Implement setCreateCache() method.
        switch ($cacheProvider) {
            case 'arrayCache':
                /**
                 *  将描述如何充分利用缓存驱动程序的API来将数据保存到缓存中，
                 *  检查是否存在缓存的数据，获取缓存的数据并删除缓存的数据。
                 *  我们将在ArrayCache这里使用 实现作为我们的例子。
                 */
                $this->cacheDriver = new arr();
                break;
            case 'memcached';
                /**
                 * 连接 Memcached 服务
                 * Memcached 缓存驱动
                 */
                $memcached = new \Memcached();
                $memcached->addServer($this->parameters['host'], $this->parameters['port']);
                $this->cacheDriver = new MemcachedCache();
                $this->cacheDriver->setMemcached($memcached);
                break;
            case 'memcache';
                $memcached = new \Memcache();
                $memcached->connect($this->parameters['host'], $this->parameters['port']);
                $this->cacheDriver = new MemcacheCache();
                $this->cacheDriver->setMemcache($memcached);
                break;
            case 'redis';
                /**
                 * 连接 Redis 服务
                 * Redis 缓存驱动
                 */
                $redis = new \Redis();
                $redis->connect($this->parameters['host'], $this->parameters['port']);
                $this->cacheDriver = new Redis();
                $this->cacheDriver->setRedis($redis);
                break;
            case 'apcu';
                /**
                 * APCu 缓存驱动
                 * 设置储存缓存数据 $lifeTime 至少 为 3秒
                 */
                $this->cacheDriver = new Apcu();
                break;
            case 'apc';
                /**
                 * APC 缓存驱动
                 * apc 由于严重的bug ,php官方已经废弃了。 出现了一个 apcu , apcu的接口和apc 是一样的。
                 * 建议用Apcu缓存驱动
                 * 设置储存缓存数据 $lifeTime 至少 为 3秒
                 */
                $this->cacheDriver = new Apc();
                break;
            case 'Xcache';
                /**
                 * Xcache 缓存驱动
                 */
                $this->cacheDriver = new X();
                break;
        }

    }

    /**
     * createCache  [设置缓存驱动程序]
     * @param $params
     * @param string $default
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public function createCache($params = [], $default = 'arrayCache')
    {
        // TODO: Implement createCache() method.
        $this->parameters = $params;
        $this->setCreateCache($default);

    }

    /**
     * get  [得到缓存]
     * @param $id 缓存ID
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function get($id = '')
    {
        // TODO: Implement get() method.
        $array = $this->cacheDriver->fetch($id);
        return $array;
    }

    /**
     * set  [设置储存缓存数据 / 您可以保存任何类型的数据，无论是字符串，数组，对象等]
     * @param $id  缓存ID
     * @param $data 数据
     * @param string $lifeTime 则为此缓存条目设置特定的生命周期（null => infinite lifeTime）
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function set($id = '', $data, $lifeTime = '')
    {
        // TODO: Implement set() method.
        $isSe = $this->cacheDriver->save($id, $data, $lifeTime);
        return $isSe;
    }

    /**
     * checking  [检查缓存ID]
     * @param $id 缓存的ID
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function checking($id = '')
    {
        // TODO: Implement checking() method.
        $isSe = $this->cacheDriver->contains($id);
        return $isSe;
    }

    /**
     * delete  [删除缓存]
     * @param $id 缓存的ID
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function delete($id = '')
    {
        // TODO: Implement delete() method.
        $isSe = $this->cacheDriver->delete($id);
        return $isSe;
    }

    /**
     * deleteAll  [删除所有的缓存]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function deleteAll()
    {
        // TODO: Implement deleteAll() method.
        $isSe = $this->cacheDriver->deleteAll();
        return $isSe;
    }

    /**
     * setNamespace  [命名空间缓存]
     * 如果您在应用程序中大量使用缓存并将其用于应用程序的多个部分，
     * 或者在同一服务器上的不同应用程序中使用缓存，则缓存命名冲突可能会有问题。
     * 这可以通过使用命名空间解决。您可以通过使用setNamespace()方法来设置缓存驱动程序应该使用的名称空间 。
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public function setNamespace($namespace)
    {
        // TODO: Implement setNamespace() method.
        $this->cacheDriver->setNamespace($namespace);
    }
}