
<?php
/*
Plugin Name: Cobro de Arriendo
Description: Plugin para gestionar arriendos con WooCommerce por categorías: vivienda, conjunto residencial y comercial.
Version: 1.0
Author: SG Design
*/

if (!defined('ABSPATH')) exit;

class CobroArriendo {
    public function __construct() {
        add_action('admin_menu', [$this, 'crear_menu_admin']);
        add_action('admin_init', [$this, 'registrar_opciones']);
    }

    public function crear_menu_admin() {
        add_menu_page('Cobro de Arriendo', 'Cobro de Arriendo', 'manage_options', 'cobro_arriendo', null, 'dashicons-building', 56);

        add_submenu_page('cobro_arriendo', 'Vivienda', 'Vivienda', 'manage_options', 'cobro_arriendo_vivienda', [$this, 'vista_vivienda']);
        add_submenu_page('cobro_arriendo', 'Conjunto Residencial', 'Conjunto Residencial', 'manage_options', 'cobro_arriendo_conjunto', [$this, 'vista_conjunto']);
        add_submenu_page('cobro_arriendo', 'Local Comercial', 'Local Comercial', 'manage_options', 'cobro_arriendo_comercial', [$this, 'vista_comercial']);
    }

    public function registrar_opciones() {
        register_setting('cobro_arriendo_vivienda_opciones', 'porcentaje_vivienda');
        register_setting('cobro_arriendo_comercial_opciones', 'porcentaje_comercial');
    }

    public function vista_vivienda() {
        ?>
        <div class="wrap">
            <h1>Configuración Vivienda</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('cobro_arriendo_vivienda_opciones');
                do_settings_sections('cobro_arriendo_vivienda_opciones');
                ?>
                <label for="porcentaje_vivienda">Porcentaje anual de aumento (%):</label>
                <input type="number" name="porcentaje_vivienda" value="<?php echo esc_attr(get_option('porcentaje_vivienda')); ?>" step="0.1" />
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function vista_conjunto() {
        echo '<div class="wrap"><h1>Conjuntos Residenciales</h1><p>No requiere configuración de aumento. Aquí se puede listar predios y pagos.</p></div>';
    }

    public function vista_comercial() {
        ?>
        <div class="wrap">
            <h1>Configuración Local Comercial</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('cobro_arriendo_comercial_opciones');
                do_settings_sections('cobro_arriendo_comercial_opciones');
                ?>
                <label for="porcentaje_comercial">Porcentaje anual de aumento (%):</label>
                <input type="number" name="porcentaje_comercial" value="<?php echo esc_attr(get_option('porcentaje_comercial')); ?>" step="0.1" />
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}

new CobroArriendo();

?>