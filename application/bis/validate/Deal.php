<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/21
 * Time: 下午3:31
 */

namespace app\bis\validate;


use think\Validate;

class Deal extends Validate
{
    protected $rule = [
        ['name','require|max:50|chsAlphaNum','团购名称不能为空|团购名称最长为50个字符|团购名称含有特殊字符'],
        ['city_id','gt:0','城市未选择'],
        ['se_city_id','gt:0','城市未选择'],
        ['location_ids','require','门店未选择'],
        ['category_id','gt:0','分类未选择'],
        ['image','require','商品图片未选择'],
        ['start_time','require','团购开始时间未选择'],
        ['end_time','require','团购结束时间未选择'],
        ['total_count','require','库存量未填写'],
        ['origin_price','require','商品原价未填写'],
        ['current_price','require','商品团购价未填写'],
        ['coupons_begin_time','require','消费券生效时间未选择'],
        ['coupons_end_time','require','消费券结束时间未选择'],
        ['id','number|require'],
        ['status','number|in:1,-1','状态为数字|状态不正确'],
    ];

    protected $scene = [
      'add'=>['name','city_id','se_city_id','location_ids',
          'category_id','start_time','end_time','total_count',
          'origin_price','current_price','coupons_begin_time','coupons_end_time',
      ],
        'remove'=>['id','status'],

    ];
}