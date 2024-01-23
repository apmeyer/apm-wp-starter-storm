<?php

namespace APM_Blocks\Accordion_Item;

function get_inner_blocks_template() {

    return [
        [ 'core/heading',
          [
              'placeholder' => 'Add heading text',
              'level' => 3,
              'lock' => [
                  'move' => true,
                  'remove' => true,
              ],
          ],
        ],
        [ 'core/group',
          [
              'layout' => [
                  'type' => 'default'
              ],
              'lock' => [
                  'move' => true,
                  'remove' => true,
              ],
          ],
          [
              [ 'core/paragraph',
                [
                    'placeholder' => 'Add content or blocks to this group. This is will expand/contract when the header is clicked.',
                ]
              ]
          ]
        ]
    ];

}