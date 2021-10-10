<?php

/*
* Add custom endpoints for wines Api.
* Creating default route to access all data  
*/


function api_wines_routes_api(){
    register_rest_route( 'bestwines/v1', '/wines', array(
        'methods' => 'GET',
        'callback' => 'api_get_wines',
    ));
}

add_action( 'rest_api_init', 'api_wines_routes_api');


// Create callback function

function api_get_wines() {
    $posts = array();
    $args = array(
        'post_type' => 'wines',
        'posts_per_page' => -1
    );

$query = new WP_Query($args);
    
    while($query->have_posts()) : $query->the_post();
        
        $id = get_the_ID();
        $slug = get_post_field( 'post_name', $id);
        $title = wp_slash(get_the_title());
        
        
        $about = apply_filters('the_content', get_post_field('post_content', $id));
        $about = strip_tags($about);
        $about = preg_replace("/\\n/", "", $about);
        $about = preg_replace("/\\r/", "", $about);
        
        $harm = get_field('descricao', $id);
        $harm = strip_tags($harm);
        $harm = preg_replace("/\\n/", "", $harm);
        $harm = preg_replace("/\\r/", "", $harm);

        $pais = get_field('pais', $id);
        $vinicula = get_field('vinicula', $id);
        $regiao = get_field('regiao', $id);
        $tipo = get_field('tipo', $id);
        $uva = get_field('uva', $id);

        $preco_total = get_field('preco_total', $id);
        $preco_desc = get_field('preco_desc', $id);

        $off = get_field('oferta', $id);
        $kit = get_field('kit', $id);
        $premiado = get_field('premiado', $id);
        $distak = get_field('distak', $id);

        $stock = get_field('stock', $id);
        $rate = get_field('rate', $id);
        $image = get_field('img', $id);

        $safra = get_field('safra', $id);
        $teor = get_field('teor', $id);
        $vol = get_field('vol', $id);
        $ts = get_field('temp_serv', $id);
        $sg = get_field('suges_guard', $id);
       

        $post = array(
            
            'id' => $id,
            'title' => $title,
            'slug' => $slug,
            'pais' => $pais,
            'regiao' => $regiao,
            'vinicula' => $vinicula,
            'tipo' => $tipo,
            'uva' => $uva,
            'safra' => $safra,
            'teor' => $teor,
            'volume' => $vol,
            'temp_serv' => $ts,
            'sobre' => $about,
            'harmonizacao' => $harm,
            'sugestao_guarda' => $sg,
            'preco_total' => $preco_total,
            'preco_desc' => $preco_desc,
            'oferta' => $off,
            'kit' => $kit,
            'premiado' => $premiado,
            'destaque' => $distak,
            'stock' => $stock,
            'avaliacao' => $rate,
            'imagem' => $image,

        );

        $posts[$slug] = $post;
    endwhile;
   
    return rest_ensure_response( $posts );
}

