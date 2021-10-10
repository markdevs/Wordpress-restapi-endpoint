<?php

function api_get_wine($request) {
    //criando a roda para pegar o ojson corrspondente ao slug da página
    //Pegar o parametro Slug
    $slug = sanitize_text_field( $request->get_param('slug') );
    //Através da função get page by path passamos o slug por parametro, 
    //após inserimos OBJECT para retornar um objeto
    //Passamos o nome do custom post type para que os campos sejam retornados de acordo com o CPT
    $page_object = get_page_by_path( $slug, OBJECT, 'wines' );
   
    /*
    Criando os dados a serem reornados do json.
    antes de iniciar para testar se já está reronando os parametros do 
    custom post type atribua o valor de 'slug' => $page_object e veja o retrono
    */

    //pegando os dados so objeto reotrnado pelo WP
    
    $id = $page_object->ID;
    $titulo = $page_object->post_title;
    $content = $page_object->post_content;
    $acf = get_fields($id);


    //Montando o retorno

    $wine = array(
        'slug' => $slug,
        'id' => $id,
        'titulo' => $titulo,
        'descricao' => $content,
        'acf' => $acf 

    );
    return rest_ensure_response( $wine );
}

function api_wine_routes_api() {
    register_rest_route( 'bestwines/v1', '/wine/(?P<slug>[-\w]+)', array(
        'methods' => 'GET',
        'callback' => 'api_get_wine',
    ) );
}

add_action('rest_api_init','api_wine_routes_api');