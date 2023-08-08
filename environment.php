<?php

//form sql 
$join_product = " product as p	
join category as c on p.category_id = c.category_id
join promotion as pm on p.promotion_id = pm.promotion_id
join unit as u on p.unit_id = u.unit_id";

$join_order = "`order` as o	join order_detail as od on o.order_id = od.order_id ";

$join_order_detail = "`order_detail` as od
join `product` as p on od.product_id = p.product_id
join `order` as o on od.order_id = o.order_id";