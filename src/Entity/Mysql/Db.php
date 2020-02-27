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

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function getDb(): ?string
    {
        return $this->db;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function getSelectPriv(): ?string
    {
        return $this->selectPriv;
    }

    public function setSelectPriv(string $selectPriv): self
    {
        $this->selectPriv = $selectPriv;

        return $this;
    }

    public function getInsertPriv(): ?string
    {
        return $this->insertPriv;
    }

    public function setInsertPriv(string $insertPriv): self
    {
        $this->insertPriv = $insertPriv;

        return $this;
    }

    public function getUpdatePriv(): ?string
    {
        return $this->updatePriv;
    }

    public function setUpdatePriv(string $updatePriv): self
    {
        $this->updatePriv = $updatePriv;

        return $this;
    }

    public function getDeletePriv(): ?string
    {
        return $this->deletePriv;
    }

    public function setDeletePriv(string $deletePriv): self
    {
        $this->deletePriv = $deletePriv;

        return $this;
    }

    public function getCreatePriv(): ?string
    {
        return $this->createPriv;
    }

    public function setCreatePriv(string $createPriv): self
    {
        $this->createPriv = $createPriv;

        return $this;
    }

    public function getDropPriv(): ?string
    {
        return $this->dropPriv;
    }

    public function setDropPriv(string $dropPriv): self
    {
        $this->dropPriv = $dropPriv;

        return $this;
    }

    public function getGrantPriv(): ?string
    {
        return $this->grantPriv;
    }

    public function setGrantPriv(string $grantPriv): self
    {
        $this->grantPriv = $grantPriv;

        return $this;
    }

    public function getReferencesPriv(): ?string
    {
        return $this->referencesPriv;
    }

    public function setReferencesPriv(string $referencesPriv): self
    {
        $this->referencesPriv = $referencesPriv;

        return $this;
    }

    public function getIndexPriv(): ?string
    {
        return $this->indexPriv;
    }

    public function setIndexPriv(string $indexPriv): self
    {
        $this->indexPriv = $indexPriv;

        return $this;
    }

    public function getAlterPriv(): ?string
    {
        return $this->alterPriv;
    }

    public function setAlterPriv(string $alterPriv): self
    {
        $this->alterPriv = $alterPriv;

        return $this;
    }

    public function getCreateTmpTablePriv(): ?string
    {
        return $this->createTmpTablePriv;
    }

    public function setCreateTmpTablePriv(string $createTmpTablePriv): self
    {
        $this->createTmpTablePriv = $createTmpTablePriv;

        return $this;
    }

    public function getLockTablesPriv(): ?string
    {
        return $this->lockTablesPriv;
    }

    public function setLockTablesPriv(string $lockTablesPriv): self
    {
        $this->lockTablesPriv = $lockTablesPriv;

        return $this;
    }

    public function getCreateViewPriv(): ?string
    {
        return $this->createViewPriv;
    }

    public function setCreateViewPriv(string $createViewPriv): self
    {
        $this->createViewPriv = $createViewPriv;

        return $this;
    }

    public function getShowViewPriv(): ?string
    {
        return $this->showViewPriv;
    }

    public function setShowViewPriv(string $showViewPriv): self
    {
        $this->showViewPriv = $showViewPriv;

        return $this;
    }

    public function getCreateRoutinePriv(): ?string
    {
        return $this->createRoutinePriv;
    }

    public function setCreateRoutinePriv(string $createRoutinePriv): self
    {
        $this->createRoutinePriv = $createRoutinePriv;

        return $this;
    }

    public function getAlterRoutinePriv(): ?string
    {
        return $this->alterRoutinePriv;
    }

    public function setAlterRoutinePriv(string $alterRoutinePriv): self
    {
        $this->alterRoutinePriv = $alterRoutinePriv;

        return $this;
    }

    public function getExecutePriv(): ?string
    {
        return $this->executePriv;
    }

    public function setExecutePriv(string $executePriv): self
    {
        $this->executePriv = $executePriv;

        return $this;
    }

    public function getEventPriv(): ?string
    {
        return $this->eventPriv;
    }

    public function setEventPriv(string $eventPriv): self
    {
        $this->eventPriv = $eventPriv;

        return $this;
    }

    public function getTriggerPriv(): ?string
    {
        return $this->triggerPriv;
    }

    public function setTriggerPriv(string $triggerPriv): self
    {
        $this->triggerPriv = $triggerPriv;

        return $this;
    }


}
