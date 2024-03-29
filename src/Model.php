<?php
#coding: utf-8
# +-------------------------------------------------------------------
# | 模型关联接口
# +-------------------------------------------------------------------
# | Copyright (c) 2017-2019 Sower rights reserved.
# +-------------------------------------------------------------------
# +-------------------------------------------------------------------
namespace sower\handle;

use Closure;
use sower\Collection;
use sower\service\database\Query;
use sower\Model;
interface Model
{
    /**
     * 延迟获取关联数据
     * @access public
     * @param  array   $subRelation 子关联
     * @param  Closure $closure     闭包查询条件
     * @return Collection
     */
    public function getRelation(array $subRelation = [], Closure $closure = null): Collection;

    /**
     * 预载入关联查询
     * @access public
     * @param  array   $resultSet   数据集
     * @param  string  $relation    当前关联名
     * @param  array   $subRelation 子关联名
     * @param  Closure $closure     闭包条件
     * @return void
     */
    public function eagerlyResultSet(array &$resultSet, string $relation, array $subRelation, Closure $closure = null): void;

    /**
     * 预载入关联查询
     * @access public
     * @param  Model   $result      数据对象
     * @param  string  $relation    当前关联名
     * @param  array   $subRelation 子关联名
     * @param  Closure $closure     闭包条件
     * @return void
     */
    public function eagerlyResult(Model $result, string $relation, array $subRelation = [], Closure $closure = null): void;

    /**
     * 关联统计
     * @access public
     * @param  Model   $result  模型对象
     * @param  Closure $closure 闭包
     * @param  string  $aggregate 聚合查询方法
     * @param  string  $field 字段
     * @param  string  $name 统计字段别名
     * @return integer
     */
    public function relationCount(Model $result, Closure $closure, string $aggregate = 'count', string $field = '*', string &$name = null);

    /**
     * 创建关联统计子查询
     * @access public
     * @param  Closure $closure 闭包
     * @param  string  $aggregate 聚合查询方法
     * @param  string  $field 字段
     * @param  string  $name 统计字段别名
     * @return string
     */
    public function getRelationCountQuery(Closure $closure = null, string $aggregate = 'count', string $field = '*', string &$name = null): string;

    /**
     * 根据关联条件查询当前模型
     * @access public
     * @param  string  $operator 比较操作符
     * @param  integer $count    个数
     * @param  string  $id       关联表的统计字段
     * @param  string  $joinType JOIN类型
     * @return Query
     */
    public function has(string $operator = '>=', int $count = 1, string $id = '*', string $joinType = 'INNER'): Query;

    /**
     * 根据关联条件查询当前模型
     * @access public
     * @param  mixed  $where 查询条件（数组或者闭包）
     * @param  mixed  $fields 字段
     * @param  string $joinType JOIN类型
     * @return Query
     */
    public function hasWhere($where = [], $fields = null, string $joinType = ''): Query;
}
