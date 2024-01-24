<?php

/**
 * APM Tabs Block
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *            This is either the post ID currently being displayed inside a query loop,
 *            or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post, or it's parent block.
 */

if ( !isset( $block ) ) $block = null;

$tabs = [
    [
        'title'   => 'Tab 1',
        'heading' => 'Tab 1 heading',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sed dui at velit convallis vehicula quis a risus. Phasellus hendrerit non lorem in porttitor. Nunc id rutrum ipsum. Pellentesque accumsan, nisl ac viverra gravida, urna est imperdiet dolor, eu fermentum leo ante vel odio. Pellentesque efficitur justo orci, eget dictum eros ullamcorper id. Duis leo libero, tempus at est ac, mattis feugiat augue. In semper est sed semper sagittis. Mauris fringilla velit turpis, quis sollicitudin mi egestas id. Pellentesque fermentum urna id mauris porta rutrum. Nulla dignissim tristique nibh, nec volutpat nulla dignissim eget. Fusce blandit tempor malesuada. Phasellus sodales ligula id elit congue, sit amet hendrerit felis pretium. Cras varius mi eget urna blandit sagittis non ac sapien.'
    ],
    [
        'title'   => 'Tab 2',
        'heading' => 'Tab 2 heading',
        'content' => 'Etiam viverra eros ut interdum dignissim. Curabitur suscipit augue nec tempor posuere. Cras pulvinar accumsan nisl non dignissim. Pellentesque vitae urna nunc. Vestibulum aliquam sed lacus eu cursus. Integer placerat lacus quis nisi ultrices dignissim. Etiam libero sem, cursus in maximus sagittis, mattis eu urna.'
    ],
    [
        'title'   => 'Tab 3',
        'heading' => 'Tab 3 heading',
        'content' => 'Nam vitae faucibus urna, vitae finibus risus. Nam venenatis mauris ipsum, vitae dictum nulla placerat aliquam. Quisque aliquet orci et quam mollis, a dictum augue rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed non fermentum magna. Sed lorem metus, rutrum vitae ante quis, condimentum consectetur sem. Integer consequat dui leo, eget rutrum risus tincidunt vitae. Mauris ultricies arcu sed nibh tempor condimentum non vitae quam. Sed id eros elementum, imperdiet sem vel, semper mauris.'
    ]
];
$count = 1;
$block_id = APM_Blocks\get_block_id( $block );

?>

<?php if ( !empty( $tabs ) ) : ?>

    <div class="<?php esc_attr_e( APM_Blocks\get_wp_block_classes( $block, 'apm-tabs' ) ) ?>"  id="<?php esc_attr_e( APM_Blocks\get_block_id( $block ) ); ?>">

        <ul class="apm-tab-list">
            <?php foreach ( $tabs as $tab ) : ?>
                <li>
                    <a id="<?php esc_attr_e( $block_id.'_tab_'.$count ); ?>"
                       <?php if ( !is_admin() ) : ?>href="#<?php esc_attr_e( $block_id.'_section_'.$count ); ?>"<?php endif; ?>>
                        <?php echo wp_kses_post( $tab['title'] ); ?>
                    </a>
                </li>
                <?php $count++; ?>
            <?php endforeach; $count = 1; ?>
        </ul>

        <?php foreach ( $tabs as $tab ) : ?>
            <section class="apm-tab-panel" id="<?php esc_attr_e( $block_id.'_section_'.$count ); ?>" aria-labelledby="<?php esc_attr_e( $block_id.'_tab_'.$count ); ?>">
                <?php echo wp_kses_post( $tab['content'] ); ?>
            </section>
            <?php $count++; ?>
        <?php endforeach; ?>

    </div>

<?php elseif ( is_admin() ) : ?>

    <p class="admin-instructions">
        <?php _e( 'Add some tabs using the sidebar controls, or switch this block to edit mode.', 'apm-blocks' ); ?>
    </p>

<?php endif; ?>
