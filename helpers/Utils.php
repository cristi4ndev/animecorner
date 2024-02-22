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
        require_once ('models/Category.php');
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
}
