<?php

namespace common\models\documents;

/**
 * This is the ActiveQuery class for [[GroupDocuments]].
 *
 * @see GroupDocuments
 */
class GroupDocumentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GroupDocuments[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GroupDocuments|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
