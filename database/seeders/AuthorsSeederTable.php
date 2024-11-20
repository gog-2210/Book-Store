<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lorem = "<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>";
        DB::table('authors')->insert(
            [
                [
                    'author_name' => '2.1/2 Bạn Tốt',
                    'author_info' => 'Tác giả: <b>2.1/2 Bạn Tốt</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'A.J.Hoge',
                    'author_info' => 'Tác giả: <b>A.J.Hoge</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Accototo',
                    'author_info' => 'Tác giả: <b>Accototo</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Adam Khoo & Gary Lee',
                    'author_info' => 'Tác giả: <b>Adam Khoo & Gary Lee</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Adam Khoo',
                    'author_info' => 'Tác giả: <b>Adam Khoo</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Agatha Christie',
                    'author_info' => 'Tác giả: <b>Agatha Christie</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Akiko Hayashi',
                    'author_info' => 'Tác giả: <b>Akiko Hayashi</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Alain de Botton',
                    'author_info' => 'Tác giả: <b>Alain de Botton</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Alan Phan ',
                    'author_info' => 'Tác giả: <b>Alan Phan </b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Alan Watts',
                    'author_info' => 'Tác giả: <b>Alan Watts</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Allan & Barbara Pease',
                    'author_info' => 'Tác giả: <b>Allan & Barbara Pease</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Alphabooks biên soạn',
                    'author_info' => 'Tác giả: <b>Alphabooks biên soạn</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Anagarika Govinda',
                    'author_info' => 'Tác giả: <b>Anagarika Govinda</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Andrea Hirata',
                    'author_info' => 'Tác giả: <b>Andrea Hirata</b><br>' . $lorem,
                    'author_image' => null
                ],
                [
                    'author_name' => 'Andrew Spooner',
                    'author_info' => 'Tác giả: <b>Andrew Spooner</b><br>' . $lorem,
                    'author_image' => null
                ]
            ]
        );
    }
}
