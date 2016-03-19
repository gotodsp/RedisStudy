<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/19
 * Time: 9:32
 */

namespace jenner\redis\study\unique;


use jenner\redis\study\tool\Logger;

class Normal
{
    protected $redis;
    protected $ips;
    const KEY = "ip-unique-normal";

    public function __construct(array $ips)
    {
        $this->redis = new \Redis();
        $this->redis->connect("127.0.0.1", 6379);
        $this->redis->select(3);


        $this->ips = $ips;
    }

    public function start()
    {
        Logger::info("unique process start");
        foreach ($this->ips as $ip) {
            $this->redis->sAdd(self::KEY, $ip);
        }

        Logger::info("unique done. ip count:" . $this->redis->sCard(self::KEY));
    }
}