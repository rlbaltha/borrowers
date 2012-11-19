<?php

namespace Borrowers\IssueBundle\Namer;

use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

/**
 * Namer class.
 */
class DirectoryNamer implements DirectoryNamerInterface
{
    /**
     * Creates a name for the file being uploaded.
     *
     * @param object $obj The object the upload is attached to.
     * @param string $field The name of the uploadable field to generate a name for.
     * @return string The file name.
     */
    function directoryName($obj, $field, $uploadDir)
    {
        $issue = $obj->getIssue();
        $issue = $issue->getIssue();
        return $uploadDir.'/'.$issue;
    }
}
