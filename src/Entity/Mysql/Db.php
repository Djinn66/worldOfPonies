<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * Db
 *
 * @ORM\Table(name="db", indexes={@ORM\Index(name="User", columns={"User"})})
 * @ORM\Entity
 */
class Db
{
    /**
     * @var string
     *
     * @ORM\Column(name="Host", type="string", length=60, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $host = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Db", type="string", length=64, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $db = '';

    /**
     * @var string
     *
     * @ORM\Column(name="User", type="string", length=80, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $user = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Select_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $selectPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Insert_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $insertPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Update_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $updatePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Delete_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $deletePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Create_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $createPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Drop_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $dropPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Grant_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $grantPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="References_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $referencesPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Index_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $indexPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Alter_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $alterPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Create_tmp_table_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $createTmpTablePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Lock_tables_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $lockTablesPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Create_view_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $createViewPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Show_view_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $showViewPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Create_routine_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $createRoutinePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Alter_routine_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $alterRoutinePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Execute_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $executePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Event_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $eventPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Trigger_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $triggerPriv = 'N';


}
