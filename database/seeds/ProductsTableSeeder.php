<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        	[
        		'name' => 'Asus UX410UAK',
        		'detail' => 'ZenBook UX410 hoàn toàn mới mang đến cho bạn sự lịch lãm, tinh tế cùng hiệu năng siêu việt trong một thiết kế mỏng và nhẹ thật lộng lẫy.',
        		'image' => 'product1.jpg',
        		'price' => 15000000,
        		'categories_id' => 3,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	],
        	[
        		'name' => 'Dell XPS15',
        		'detail' => 'The world’s only 15.6-inch InfinityEdge display: The virtually borderless display maximizes screen space by accommodating a 15.6-inch display inside a laptop closer to the size of a 14-inch',
        		'image' => 'product2.jpg',
        		'price' => 17000000,
        		'categories_id' => 4,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	],
        	[
        		'name' => 'Lennovo Thinkpad T420',
        		'detail' => 'ThinkPad T420 có kích thước 34 cm x 23 cm x 3cm và nặng 2,24 kg, được trang bị màn hình 14 inch LED với lớp phủ mờ kết hợp chống lóa và bảo vệ thông tin ',
        		'image' => 'product3.jpg',
        		'price' => 14000000,
        		'categories_id' => 5,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	],
        	[
        		'name' => 'Iphone 7s plus',
        		'detail' => 'Kể từ khi ra mắt lần đầu tiên vào năm 2007, Apple đã đánh dấu sự thay đổi toàn diện của ngành công nghiệp di động với các dòng sản phẩm iPhone.',
        		'image' => 'product4.jpg',
        		'price' => 25000000,
        		'categories_id' => 6,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	],
        	[
        		'name' => 'SamSung Note7',
        		'detail' => 'Pin là nguyên nhân khiến sản phẩm phát nổ. Tuy nhiên, mọi chuyện không đơn giản như vậy. Trong cuộc họp báo hôm chủ nhật (22/1)',
        		'image' => 'product5.jpg',
        		'price' => 20000000,
        		'categories_id' => 7,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	],
        	[
        		'name' => 'HTC 8X',
        		'detail' => 'Hơn 5 tháng kể từ khi quay lại thị trường với mức giá chính thức chỉ 4,59 triệu đồng, HTC Windows Phone 8X dù không phải là một mẫu smartphone mới nhưng vẫn nằm trong tầm ngắm của nhiều người dùng.',
        		'image' => 'product6.jpg',
        		'price' => 10000000,
        		'categories_id' => 8,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	],

        ]);
    }
}
