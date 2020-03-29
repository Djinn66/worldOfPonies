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

    /**
     * @var string
     *
     */
    private $dBPriv = '';

    /**
     * @return string
     */
    public function getDBPriv(): string
    {

        $array = $this->getAllPrivileges();
        foreach (array_keys($array) as $key)
        {
            if ($array[$key]!=-1)
            {
                $this->dBPriv .= $key.',';
            }
        }


        return rtrim($this->dBPriv,",");
    }
    /**
     * @var array
     */
    public $allPrivileges = [

        'Select'=> 0,
        'Insert'=> 1,
        'Update'=> 2,
        'Delete'=> 3,
        'Create'=> 4,
        'Drop'=> 5,
        'Grant'=> 6,
        'References'=> 7,
        'Index'=> 8,
        'Alter'=> 9,
        'Create tmp table'=> 10,
        'Lock tables'=> 11,
        'Create view'=> 12,
        'Show view'=> 13,
        'Create routine'=> 14,
        'Alter routine'=> 15,
        'Execute'=> 16,
        'Event'=> 17,
        'Trigger'=> 18,
    ];


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

    public function getAllPrivileges():array
    {
        $allPrivileges['Select']=($this->selectPriv=='Y')?0:-1;
        $allPrivileges['Insert']=($this->insertPriv=='Y')?1:-1;
        $allPrivileges['Update']=($this->updatePriv=='Y')?2:-1;
        $allPrivileges['Delete']=($this->deletePriv=='Y')?3:-1;
        $allPrivileges['Create']=($this->createPriv=='Y')?4:-1;
        $allPrivileges['Drop']=($this->dropPriv=='Y')?5:-1;
        $allPrivileges['Grant']=($this->grantPriv=='Y')?6:-1;
        $allPrivileges['References']=($this->referencesPriv=='Y')?7:-1;
        $allPrivileges['Index']=($this->indexPriv=='Y')?8:-1;
        $allPrivileges['Alter']=($this->alterPriv=='Y')?9:-1;
        $allPrivileges['Create tmp table']=($this->createTmpTablePriv=='Y')?10:-1;
        $allPrivileges['Lock tables']=($this->lockTablesPriv=='Y')?11:-1;
        $allPrivileges['Create view']=($this->createViewPriv=='Y')?12:-1;
        $allPrivileges['Show view']=($this->showViewPriv=='Y')?13:-1;
        $allPrivileges['Create routine']=($this->createRoutinePriv=='Y')?14:-1;
        $allPrivileges['Alter routine']=($this->alterRoutinePriv=='Y')?15:-1;
        $allPrivileges['Execute']=($this->executePriv=='Y')?16:-1;
        $allPrivileges['Event']=($this->eventPriv=='Y')?17:-1;
        $allPrivileges['Trigger']=($this->triggerPriv=='Y')?18:-1;
        return $allPrivileges;
    }

    public function setAllPrivileges(array $allPrivileges) : self
    {
        $this->resetAllPrivileges();


        foreach ($allPrivileges as $privilege){
            switch ($privilege){
                case 0 :    $this->allPrivileges['Select']=0;
                            $this->setSelectPriv('Y');
                            break;
                case 1:     $this->allPrivileges['Insert']=1;
                            $this->setInsertPriv('Y');
                            break;
                case 2:     $this->allPrivileges['Update']=2;
                            $this->setUpdatePriv('Y');
                            break;
                case 3:     $this->allPrivileges['Delete']=3;
                            $this->setDeletePriv('Y');
                            break;
                case 4:     $this->allPrivileges['Create']=4;
                            $this->setCreatePriv('Y');
                            break;
                case 5:     $this->allPrivileges['Drop']=5;
                            $this->setDropPriv('Y');
                            break;
                case 6:     $this->allPrivileges['Grant']=6;
                            $this->setGrantPriv('Y');
                            break;
                case 7:     $this->allPrivileges['References']=7;
                            $this->setReferencesPriv('Y');
                            break;
                case 8:     $this->allPrivileges['Index']=8;
                            $this->setIndexPriv('Y');
                            break;
                case 9:     $this->allPrivileges['Alter']=9;
                            $this->setAlterPriv('Y');
                            break;
                case 10:    $this->allPrivileges['Create tmp table']=10;
                            $this->setCreateTmpTablePriv('Y');
                            break;
                case 11:    $this->allPrivileges['Lock tables']=11;
                            $this->setLockTablesPriv('Y');
                            break;
                case 12:    $this->allPrivileges['Create view']=12;
                            $this->setCreateViewPriv('Y');
                            break;
                case 13:    $this->allPrivileges['Show view']=13;
                            $this->setShowViewPriv('Y');
                            break;
                case 14:    $this->allPrivileges['Create routine']=14;
                            $this->setCreateRoutinePriv('Y');
                            break;
                case 15:    $this->allPrivileges['Alter routine']=15;
                            $this->setAlterRoutinePriv('Y');
                            break;
                case 16:    $this->allPrivileges['Execute']=16;
                            $this->setExecutePriv('Y');
                            break;
                case 17:    $this->allPrivileges['Event']=17;
                            $this->setEventPriv('Y');
                            break;
                case 18:    $this->allPrivileges['Trigger']=18;
                            $this->setTriggerPriv('Y');
                            break;
                default;
            }
        }
        return $this ;
    }

    /**
     * fonction qui reset les privilèges (reset = -1)
     */
    public function resetAllPrivileges():self
    {
        foreach ($this->allPrivileges as $value)
        {
            $value = -1;
        }

        $this->setSelectPriv('N');
        $this->setInsertPriv('N');
        $this->setUpdatePriv('N');
        $this->setDeletePriv('N');
        $this->setCreatePriv('N');
        $this->setDropPriv('N');
        $this->setGrantPriv('N');
        $this->setReferencesPriv('N');
        $this->setIndexPriv('N');
        $this->setAlterPriv('N');
        $this->setCreateTmpTablePriv('N');
        $this->setLockTablesPriv('N');
        $this->setCreateViewPriv('N');
        $this->setAlterRoutinePriv('N');
        $this->setExecutePriv('N');
        $this->setEventPriv('N');
        $this->setTriggerPriv('N');

        return $this;
    }


}
