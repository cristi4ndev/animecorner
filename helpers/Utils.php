<?php
class Utils
{
    public static function isAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: " . base_url);
        }
    }
    public static function isCustomer()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'customer') {
            header("Location: " . base_url . "user/");
        }
    }

    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function getCategoryName($array, $id)
    {

        $filtered_array = array_filter($array, function ($array) use ($id) {
            return $array['id'] == $id;
        });

        // Verificar si se encontró un elemento en el array filtrado
        if (!empty($filtered_array)) {
            // Como array_filter devuelve un array, obtenemos el primer elemento
            $first_element = reset($filtered_array);
            $category_name = $first_element['name'];
            return $category_name;
        } else {
            // Si no se encontró ninguna coincidencia, devolvemos null
            return null;
        }
    }
    public static function getCategories()
    {

        $category_model = new Category();
        $categories = $category_model->getAll();
        return $categories;
    }

    // Función recursiva para imprimir el árbol de categorías
    public static function printCategoriesTree($categories, $parent_id = 0, $level = 0)
    {
        echo "<ul class='level-$level'>";

        foreach ($categories as $category) {
            if ($category['parent'] == $parent_id) {
                echo "<li><a href='" . base_url . "admin/categories&id={$category['id']}'>{$category['name']}</a></li>";
                Utils::printCategoriesTree($categories, $category['id'], $level + 1);
            }
        }
        echo "</ul>";
    }
    // Función recursiva para imprimir el árbol de categorías para filtrar productos
    public static function filterProductsByCategory($parent_id = 0, $level = 0)
    {
        require_once 'models/Category.php';
        $category_model = new Category();
        $categories = $category_model->getAll();
        echo "<ul class='level-$level'>";

        foreach ($categories as $category) {
            if ($category['parent'] == $parent_id) {
                echo "<li><a href='" . base_url . "admin/categories&id={$category['id']}'>{$category['name']}</a></li>";
                Utils::filterProductsByCategory($category['id'], $level + 1);
            }
        }
        echo "</ul>";
    }
    // Función para comprobar si una categoría tiene subcategorías
    public static function categoryHasChildren($id)
    {
        $category_model = new Category();
        $category_model->setParent($id);
        $has_parent = $category_model->getCategories();
        return $has_parent;
    }
    // Función para devolver el nombre de una entidad según su ID

    public static function getEntityName($array, $id)
    {

        $filtered_array = array_filter($array, function ($array) use ($id) {
            return $array['id'] == $id;
        });

        // Verificar si se encontró un elemento en el array filtrado
        if (!empty($filtered_array)) {
            // Como array_filter devuelve un array, obtenemos el primer elemento
            $first_element = reset($filtered_array);
            $name = $first_element['name'];
            return $name;
        } else {
            // Si no se encontró ninguna coincidencia, devolvemos null
            return null;
        }
    }
    public static function getMenu()
    {
        require_once('models/Category.php');
        $category_model = new Category();
        $categories = $category_model->getAll();
        $menu_categories = array_filter($categories, function ($array) {
            return $array['menu'] == 1;
        });


        // Verificar si se encontró un elemento en el array filtrado
        if (!empty($menu_categories)) {

            return $menu_categories;
        } else {
            // Si no se encontró ninguna coincidencia, devolvemos null
            return null;
        }
    }
    public static function getSagas()
    {
        require_once('models/Saga.php');
        $saga_model = new Saga();
        $sagas = $saga_model->getAll();


        // Verificar si se encontró un elemento en el array filtrado
        if (!empty($sagas)) {

            return $sagas;
        } else {
            // Si no se encontró ninguna coincidencia, devolvemos null
            return null;
        }
    }
    // Devolver el nombre de la saga según id
    public static function getSagaById($id)
    {
        require_once('models/Saga.php');
        $saga_model = new Saga();
        $saga_model->setId($id);
        $saga_name = $saga_model->getOne();


        // Verificar si se encontró un elemento en el array filtrado
        if (!empty($saga_name)) {

            return $saga_name['name'];
        } else {
            // Si no se encontró ninguna coincidencia, devolvemos null
            return null;
        }
    }
    // Devolver el nombre de la categoría según id
    public static function getCategoryById($id)
    {
        require_once('models/Category.php');
        $category_model = new Category();
        $category_model->setId($id);
        $category_name = $category_model->getOne();


        // Verificar si se encontró un elemento en el array filtrado
        if (!empty($category_name)) {

            return $category_name['name'];
        } else {
            // Si no se encontró ninguna coincidencia, devolvemos null
            return null;
        }
    }
    public static function getSagasAndChars()
    {
        require_once('models/Character.php');
        $char_model = new Character();
        $characters = $char_model->getAllJoinChars();



        // Verificar si se encontró un elemento en el array filtrado
        if (!empty($characters)) {

            return $characters;
        } else {
            // Si no se encontró ninguna coincidencia, devolvemos null
            return null;
        }
    }

    // Devuelve un array de personajes según el id Saga
    public static function getCharactersById($id)
    {
        require_once('models/Character.php');
        $char_model = new Character();
        $char_model->setSagaId($id);
        $characters = $char_model->getAllBySagaId();



        // Verificar si se encontró un elemento en el array filtrado
        if (!empty($characters)) {

            return $characters;
        } else {
            // Si no se encontró ninguna coincidencia, devolvemos null
            return null;
        }
    }

    // devuelve los personajes de un id de Producto
    public static function getCharsByProduct($id)
    {
        require_once('models/ProductCharacters.php');
        $chars_model = new ProductCharacters();
        $chars_model->setProductId($id);
        $characters = $chars_model->getCharsByProduct();



        // Verificar si se encontró un elemento en el array filtrado
        if (!empty($characters)) {

            return $characters;
        } else {
            // Si no se encontró ninguna coincidencia, devolvemos null
            return null;
        }
    }

    public static function printOrderStatus($status)
    {
        if ($status == "pedido confirmado") {
            return '<span class="status-confirmed"><i class="fa-solid fa-clipboard-check"></i>' . $status . '</span>';
        }

        if ($status == "enviado") {
            return '<span class="status-sent"><i class="fa-solid fa-truck-fast"></i>' . $status . '</span>';
        }

        if ($status == "cancelado") {
            return '<span class="status-canceled"><i class="fa-solid fa-ban"></i>' . $status . '</span>';
        }
        if ($status == "entregado") {
            return '<span class="status-completed"><i class="fa-solid fa-circle-check"></i>' . $status . '</span>';
        }
    }
}
