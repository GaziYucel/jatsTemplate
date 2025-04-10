<?php

/**
 * @file ArticleBack.php
 *
 * Copyright (c) 2003-2025 Simon Fraser University
 * Copyright (c) 2003-2025 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @brief JATS xml article back element
 */

namespace APP\plugins\generic\jatsTemplate\classes;

use APP\publication\Publication;
use DOMDocument;
use DOMNode;

class ArticleBack extends DOMDocument
{
    /**
     * create xml back DOMNode
     */
    public function create(Publication $publication): DOMNode
    {
        // create element back
        $backElement = $this->appendChild($this->createElement('back'));

        $citations = $publication->getData('citations');
        if (count($citations)) {
            // create element ref-list
            $refListElement = $backElement->appendChild($this->createElement('ref-list'));
            $i = 1;
            foreach ($citations as $citation) {
                // create element ref
                $refListElement
                    ->appendChild($this->createElement('ref'))
                    ->setAttribute('id', 'R' . $i)
                    ->parentNode
                    ->appendChild($this->createElement('mixed-citation', htmlspecialchars($citation->getRawCitation())));
                $i++;
            }
        }

        return $backElement;
    }
}
