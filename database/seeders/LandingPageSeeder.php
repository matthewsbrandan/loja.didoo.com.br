<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = [
            ['title'=>'{"pt":"Crie o seu menu"}',
            'description'=>'{"pt":"Crie seu cardápio diretamente em nossa plataforma. Atualize a qualquer hora. Fácil e simples."}',
            'image'=>asset('social').'/img/SVG/512/menu.svg'],
            ['title'=>'{"pt":"Pedidos via chat"}',
            'description'=>'{"pt":"Você receberá o pedido em seu WhatsApp. Continue o chat e finalize o pedido"}',
            'image'=>asset('social').'/img/SVG/512/chat.svg'],
            ['title'=>'{"pt":"Métodos de Pagamento"}',
            'description'=>'{"pt":"Aceite dinheiro na entrega ou receba o pagamento diretamente através do link de pagamento. Mais de 20 métodos de pagamento disponíveis."}',
            'image'=>asset('social').'/img/SVG/512/money.svg'],
            ['title'=>'{"pt":"Comece a fazer pedidos"}',
            'description'=>'{"pt":"Basta criar o seu cardápio, e a próxima coisa que você sabe, é receber pedidos no seu celular via WhatsApp."}',
            'image'=>asset('social').'/img/SVG/512/ordering.svg'],
            ['title'=>'{"pt":"Análise de visualizações e pedidos"}',
            'description'=>'{"pt":"Obtenha um relatório detalhado sobre seus pedidos e ganhos. Acompanhe seu negócio à medida que ele cresce conosco."}',
            'image'=>asset('social').'/img/SVG/512/analytics.svg'],
            ['title'=>'{"pt":"Conheça seus clientes"}',
            'description'=>'{"pt":"Você está criando um vínculo direto com seus clientes. Cliente fiel, saberá onde encontrá-lo na próxima vez."}',
            'image'=>asset('social').'/img/SVG/512/customers.svg'],
        ];

        // $testimonials = [
        //     ['title'=>'{"en":"Gabriel Martin"}', 'subtitle'=>'{"en":"Bistrot Paul Bert, France"}', 'description'=>'{"en":"We knew that we need tool like this one. And we finally found it. Managing orders faster than ever."}', 'image'=>asset('social').'/img/faces/christian.jpg'],
        //     ['title'=>'{"en":"Emma Müller "}', 'subtitle'=>'{"en":"Amador, Germany"}', 'description'=>'{"en":"No more 30% fee on food delivery platforms. This is super cheap platforms thant saved us ton of money.  "}', 'image'=>asset('social').'/img/faces/team-4.jpg'], 
        //     ['title'=>'{"en":"John Smith"}', 'subtitle'=>'{"en":"Brooklyn Taco, USA"}', 'description'=>'{"en":"We where previously chatting with customers on whatsapp so they can order. This is next level."}', 'image'=>asset('social').'/img/faces/michael.jpg'],
        //     ['title'=>'{"en":"Maxim Ivanov"}', 'subtitle'=>'{"en":"Babushka, Russia"}', 'description'=>'{"en":"Being able to pay directly in WhatsApp, is so great. And the best of all, money goes directly to us."}', 'image'=>asset('social').'/img/faces/team-1.jpg'],
        //     ['title'=>'{"en":"Alexandra Papadopulos"}', 'subtitle'=>'{"en":"Odyssey, Greece"}', 'description'=>'{"en":"They have the best digital menu creator. Together with the QR code generator it is best on market"}', 'image'=>asset('social').'/img/faces/team-3.jpg'],
        //     ['title'=>'{"en":"Maria Santos"}', 'subtitle'=>'{"en":"Brasa, Brazil"}', 'description'=>'{"en":"Orders from customers on Facebook, Instagram and web on Whatsapp. Can I ask for more!"}', 'image'=>asset('social').'/img/faces/team-2.jpg'],
        // ];

        $processes = [
            ['title'=>'{"pt":"Para pedidos de clientes"}', 'description'=>'{"pt":"O cliente pode encontrar o link para o catálogo da loja nas plataformas sociais, no boca a boca via amigo ou se escanear o QR. Depois de fazer o pedido pelo catálogo online, ele pode enviar o pedido diretamente para o WhatsApp da Loja."}','link_name'=>'Comece agora', 'link'=>''],
            ['title'=>'{"pt":"Para proprietários de lojas"}', 'description'=>'{"pt":"O processo começa quando eles ouvem um novo som de mensagem em seu WhatsApp. Eles, ou um robô treinado, podem fazer perguntas para obter detalhes sobre o pedido e o endereço de entrega. A loja também pode informar quanto tempo levará para a entrega do pedido."}','link_name'=>'Comece agora', 'link'=>''],
        ];

        foreach ($features as $key => $feature) {
            DB::table('posts')->insert([
                'post_type' => 'feature',
                'title' => $feature['title'],
                'description' => $feature['description'],
                'image' => $feature['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // foreach ($testimonials as $key => $testimonial) {
        //     DB::table('posts')->insert([
        //         'post_type' => 'testimonial',
        //         'title' => $testimonial['title'],
        //         'subtitle' => $testimonial['subtitle'],
        //         'description' => $testimonial['description'],
        //         'image' => $testimonial['image'],
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        foreach ($processes as $key => $process) {
            DB::table('posts')->insert([
                'post_type' => 'process',
                'title' => $process['title'],
                'description' => $process['description'],
                'link_name' => $process['link_name'],
                'link' => $process['link'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
