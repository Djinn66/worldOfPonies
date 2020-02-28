<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\Mysql\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Column(name="User", type="string", length=80, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $user = '';


    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=41, nullable=false, options={"fixed"=true})
     */
    private $password = '';

    /**
     * @var string
     *
     * @ORM\Column(name="Select_priv", type="string",length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $selectPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Insert_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $insertPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Update_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $updatePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Delete_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $deletePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Create_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $createPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Drop_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $dropPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Reload_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $reloadPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Shutdown_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $shutdownPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Process_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $processPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="File_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $filePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Grant_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $grantPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="References_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $referencesPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Index_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $indexPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Alter_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $alterPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Show_db_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $showDbPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Super_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
     */
    private $superPriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Create_tmp_table_priv", type="string", length=1, columnDefinition="ENUM('N', 'Y')", nullable=false, options={"default"="N"})
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
     * @ORM\Column(name="Execute_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $executePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Repl_slave_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $replSlavePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="Repl_client_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $replClientPriv = 'N';

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
     * @ORM\Column(name="Create_user_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $createUserPriv = 'N';

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
     * @ORM\Column(name="Create_tablespace_priv", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $createTablespacePriv = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="ssl_type", type="string", length=0, nullable=false)
     */
    private $sslType = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ssl_cipher", type="blob", length=65535, nullable=false)
     */
    private $sslCipher;

    /**
     * @var string
     *
     * @ORM\Column(name="x509_issuer", type="blob", length=65535, nullable=false)
     */
    private $x509Issuer;

    /**
     * @var string
     *
     * @ORM\Column(name="x509_subject", type="blob", length=65535, nullable=false)
     */
    private $x509Subject;

    /**
     * @var int
     *
     * @ORM\Column(name="max_questions", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $maxQuestions = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="max_updates", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $maxUpdates = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="max_connections", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $maxConnections = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="max_user_connections", type="integer", nullable=false)
     */
    private $maxUserConnections = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="plugin", type="string", length=64, nullable=false, options={"fixed"=true})
     */
    private $plugin = '';

    /**
     * @var string
     *
     * @ORM\Column(name="authentication_string", type="text", length=65535, nullable=false)
     */
    private $authenticationString;

    /**
     * @var string
     *
     * @ORM\Column(name="password_expired", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $passwordExpired = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="is_role", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $isRole = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="default_role", type="string", length=80, nullable=false, options={"fixed"=true})
     */
    private $defaultRole = '';

    /**
     * @var string
     *
     * @ORM\Column(name="max_statement_time", type="decimal", precision=12, scale=6, nullable=false, options={"default"="0.000000"})
     */
    private $maxStatementTime = '0.000000';

    /**
     * @var array
     */
    public $allPrivileges = [
        'selectPriv'=> 0,
        'insertPriv'=> 1,
        'updatePriv'=>2,
        'deletePriv'=>3,
        'createPriv'=>4,
        'dropPriv'=>5,
        'reloadPriv'=>6,
        'shutdownPriv'=>7,
        'processPriv'=>8,
        'filePriv'=>9,
        'grantPriv'=>10,
        'referencesPriv'=>11,
        'indexPriv'=>12,
        'alterPriv'=>13,
        'showDbPriv'=>14,
        'superPriv'=>15,
        'createTmpTablePriv'=>16,
        'lockTablesPriv'=>17,
        'executePriv'=>18,
        'replSlavePriv'=>19,
        'replClientPriv'=>20,
        'createViewPriv'=>21,
        'showViewPriv'=>22,
        'createRoutinePriv'=>23,
        'alterRoutinePriv'=>24,
        'createUserPriv'=>25,
        'eventPriv'=>26,
        'triggerPriv'=>27,
        'createTablespacePriv'=>28
    ];

    // getters & setters

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = "*".sha1(sha1($password));

        return $this;
    }

    public function getSelectPriv(): string
    {
        return $this->selectPriv;
    }

    public function setSelectPriv(string $selectPriv): self
    {
        $this->selectPriv=$selectPriv;

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

    public function getReloadPriv(): ?string
    {
        return $this->reloadPriv;
    }

    public function setReloadPriv(string $reloadPriv): self
    {
        $this->reloadPriv = $reloadPriv;

        return $this;
    }

    public function getShutdownPriv(): ?string
    {
        return $this->shutdownPriv;
    }

    public function setShutdownPriv(string $shutdownPriv): self
    {
        $this->shutdownPriv = $shutdownPriv;

        return $this;
    }

    public function getProcessPriv(): ?string
    {
        return $this->processPriv;
    }

    public function setProcessPriv(string $processPriv): self
    {
        $this->processPriv = $processPriv;

        return $this;
    }

    public function getFilePriv(): ?string
    {
        return $this->filePriv;
    }

    public function setFilePriv(string $filePriv): self
    {
        $this->filePriv = $filePriv;

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

    public function getShowDbPriv(): ?string
    {
        return $this->showDbPriv;
    }

    public function setShowDbPriv(string $showDbPriv): self
    {
        $this->showDbPriv = $showDbPriv;

        return $this;
    }

    public function getSuperPriv(): ?string
    {
        return $this->superPriv;
    }

    public function setSuperPriv(string $superPriv): self
    {
        $this->superPriv = $superPriv;

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

    public function getExecutePriv(): ?string
    {
        return $this->executePriv;
    }

    public function setExecutePriv(string $executePriv): self
    {
        $this->executePriv = $executePriv;

        return $this;
    }

    public function getReplSlavePriv(): ?string
    {
        return $this->replSlavePriv;
    }

    public function setReplSlavePriv(string $replSlavePriv): self
    {
        $this->replSlavePriv = $replSlavePriv;

        return $this;
    }

    public function getReplClientPriv(): ?string
    {
        return $this->replClientPriv;
    }

    public function setReplClientPriv(string $replClientPriv): self
    {
        $this->replClientPriv = $replClientPriv;

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

    public function getCreateUserPriv(): ?string
    {
        return $this->createUserPriv;
    }

    public function setCreateUserPriv(string $createUserPriv): self
    {
        $this->createUserPriv = $createUserPriv;

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

    public function getCreateTablespacePriv(): ?string
    {
        return $this->createTablespacePriv;
    }

    public function setCreateTablespacePriv(string $createTablespacePriv): self
    {
        $this->createTablespacePriv = $createTablespacePriv;

        return $this;
    }

    public function getSslType(): ?string
    {
        return $this->sslType;
    }

    public function setSslType(string $sslType): self
    {
        $this->sslType = $sslType;

        return $this;
    }

    public function getSslCipher()
    {
        return $this->sslCipher;
    }

    public function setSslCipher($sslCipher): self
    {
        $this->sslCipher = $sslCipher;

        return $this;
    }

    public function getX509Issuer()
    {
        return $this->x509Issuer;
    }

    public function setX509Issuer($x509Issuer): self
    {
        $this->x509Issuer = $x509Issuer;

        return $this;
    }

    public function getX509Subject()
    {
        return $this->x509Subject;
    }

    public function setX509Subject($x509Subject): self
    {
        $this->x509Subject = $x509Subject;

        return $this;
    }

    public function getMaxQuestions(): ?int
    {
        return $this->maxQuestions;
    }

    public function setMaxQuestions(int $maxQuestions): self
    {
        $this->maxQuestions = $maxQuestions;

        return $this;
    }

    public function getMaxUpdates(): ?int
    {
        return $this->maxUpdates;
    }

    public function setMaxUpdates(int $maxUpdates): self
    {
        $this->maxUpdates = $maxUpdates;

        return $this;
    }

    public function getMaxConnections(): ?int
    {
        return $this->maxConnections;
    }

    public function setMaxConnections(int $maxConnections): self
    {
        $this->maxConnections = $maxConnections;

        return $this;
    }

    public function getMaxUserConnections(): ?int
    {
        return $this->maxUserConnections;
    }

    public function setMaxUserConnections(int $maxUserConnections): self
    {
        $this->maxUserConnections = $maxUserConnections;

        return $this;
    }

    public function getPlugin(): ?string
    {
        return $this->plugin;
    }

    public function setPlugin(string $plugin): self
    {
        $this->plugin = $plugin;

        return $this;
    }

    public function getAuthenticationString(): ?string
    {
        return $this->authenticationString;
    }

    public function setAuthenticationString(string $authenticationString): self
    {
        $this->authenticationString = $authenticationString;

        return $this;
    }

    public function getPasswordExpired(): ?string
    {
        return $this->passwordExpired;
    }

    public function setPasswordExpired(string $passwordExpired): self
    {
        $this->passwordExpired = $passwordExpired;

        return $this;
    }

    public function getIsRole(): ?string
    {
        return $this->isRole;
    }

    public function setIsRole(string $isRole): self
    {
        $this->isRole = $isRole;

        return $this;
    }

    public function getDefaultRole(): ?string
    {
        return $this->defaultRole;
    }

    public function setDefaultRole(string $defaultRole): self
    {
        $this->defaultRole = $defaultRole;

        return $this;
    }

    public function getMaxStatementTime(): ?string
    {
        return $this->maxStatementTime;
    }

    public function setMaxStatementTime(string $maxStatementTime): self
    {
        $this->maxStatementTime = $maxStatementTime;

        return $this;
    }

    public function getAllPrivileges():array
    {
        $allPrivileges['selectPriv']=($this->selectPriv=='Y')?0:-1;
        $allPrivileges['insertPriv']=($this->insertPriv=='Y')?1:-1;
        $allPrivileges['updatePriv']=($this->updatePriv=='Y')?2:-1;
        $allPrivileges['deletePriv']=($this->deletePriv=='Y')?3:-1;
        $allPrivileges['createPriv']=($this->createPriv=='Y')?4:-1;
        $allPrivileges['dropPriv']=($this->dropPriv=='Y')?5:-1;
        $allPrivileges['reloadPriv']=($this->reloadPriv=='Y')?6:-1;
        $allPrivileges['shutdownPriv']=($this->shutdownPriv=='Y')?7:-1;
        $allPrivileges['processPriv']=($this->processPriv=='Y')?8:-1;
        $allPrivileges['filePriv']=($this->filePriv=='Y')?9:-1;
        $allPrivileges['grantPriv']=($this->grantPriv=='Y')?10:-1;
        $allPrivileges['referencesPriv']=($this->referencesPriv=='Y')?11:-1;
        $allPrivileges['indexPriv']=($this->indexPriv=='Y')?12:-1;
        $allPrivileges['alterPriv']=($this->alterPriv=='Y')?13:-1;
        $allPrivileges['showDbPriv']=($this->showDbPriv=='Y')?14:-1;
        $allPrivileges['superPriv']=($this->superPriv=='Y')?15:-1;
        $allPrivileges['createTmpTablePriv']=($this->createTmpTablePriv=='Y')?16:-1;
        $allPrivileges['lockTablesPriv']=($this->lockTablesPriv=='Y')?17:-1;
        $allPrivileges['executePriv']=($this->executePriv=='Y')?18:-1;
        $allPrivileges['replSlavePriv']=($this->replSlavePriv=='Y')?19:-1;
        $allPrivileges['replClientPriv']=($this->replClientPriv=='Y')?20:-1;
        $allPrivileges['createViewPriv']=($this->createViewPriv=='Y')?21:-1;
        $allPrivileges['showViewPriv']=($this->showViewPriv=='Y')?22:-1;
        $allPrivileges['createRoutinePriv']=($this->createRoutinePriv=='Y')?23:-1;
        $allPrivileges['alterRoutinePriv']=($this->alterRoutinePriv=='Y')?24:-1;
        $allPrivileges['createUserPriv']=($this->createUserPriv=='Y')?25:-1;
        $allPrivileges['eventPriv']=($this->eventPriv=='Y')?26:-1;
        $allPrivileges['triggerPriv']=($this->triggerPriv=='Y')?27:-1;
        $allPrivileges['createTablespacePriv']=($this->createTablespacePriv=='Y')?28:-1;
        return $allPrivileges;
    }

    public function setAllPrivileges(array $allPrivileges) : self
    {
        $this->resetAllPrivileges();

        foreach ($allPrivileges as $privilege){
            switch ($privilege){
                case 0 :    $this->allPrivileges['selectPriv']=0;
                    $this->setSelectPriv('Y');
                    break;
                case 1:     $this->allPrivileges['insertPriv']=1;
                    $this->setInsertPriv('Y');
                    break;
                case 2:     $this->allPrivileges['updatePriv']=2;
                    $this->setUpdatePriv('Y');
                    break;
                case 3:     $this->allPrivileges['deletePriv']=3;

                    break;
                case 4:     $this->allPrivileges['createPriv']=4;
                    break;
                case 5:     $this->allPrivileges['dropPriv']=5;
                    break;
                case 6:     $this->allPrivileges['reloadPriv']=6;
                    break;
                case 7:     $this->allPrivileges['shutdownPriv']=7;
                    break;
                case 8:     $this->allPrivileges['processPriv']=8;
                    break;
                case 9:    $this->allPrivileges['filePriv']=9;
                    break;
                case 10:    $this->allPrivileges['grantPriv']=10;
                    break;
                case 11:    $this->allPrivileges['referencesPriv']=11;
                    break;
                case 12:    $this->allPrivileges['indexPriv']=12;
                    break;
                case 13:    $this->allPrivileges['alterPriv']=13;
                    break;
                case 14:    $this->allPrivileges['showDbPriv']=14;
                    break;
                case 15:    $this->allPrivileges['superPriv']=15;
                    break;
                case 16:    $this->allPrivileges['createTmpTablePriv']=16;
                    break;
                case 17:    $this->allPrivileges['lockTablesPriv']=17;
                    break;
                case 18:    $this->allPrivileges['executePriv']=18;
                    break;
                case 19:    $this->allPrivileges['replSlavePriv']=19;
                    break;
                case 20:    $this->allPrivileges['replClientPriv']=20;
                    break;
                case 21:    $this->allPrivileges['createViewPriv']=21;
                    break;
                case 22:    $this->allPrivileges['showViewPriv']=22;
                    break;
                case 23:    $this->allPrivileges['createRoutinePriv']=23;
                    break;
                case 24:    $this->allPrivileges['alterRoutinePriv']=24;
                    break;
                case 25:    $this->allPrivileges['createUserPriv']=25;
                    break;
                case 26:    $this->allPrivileges['eventPriv']=26;
                    break;
                case 27:    $this->allPrivileges['triggerPriv']=27;
                    break;
                case 28:    $this->allPrivileges['createTablespacePriv']=28;
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
        $this->setReloadPriv('N');
        $this->setShutdownPriv('N');
        $this->setProcessPriv('N');
        $this->setFilePriv('N');
        $this->setGrantPriv('N');
        $this->setIndexPriv('N');
        $this->setAlterPriv('N');
        $this->setShowDbPriv('N');
        $this->setSuperPriv('N');
        $this->setCreateTmpTablePriv('N');
        $this->setLockTablesPriv('N');
        $this->setExecutePriv('N');
        $this->setReplSlavePriv('N');
        $this->setCreateViewPriv('N');
        $this->setShowViewPriv('N');
        $this->setCreateRoutinePriv('N');
        $this->setAlterRoutinePriv('N');
        $this->setCreateUserPriv('N');
        $this->setEventPriv('N');
        $this->setTriggerPriv('N');
        $this->setCreateTablespacePriv('N');

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return ['ROLE_'.strtoupper($this->getUser())];
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->user.'@'.$this->host;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        return serialize(array(
            $this->user,
            $this->host,
            $this->password
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        list(
            $this->user,
            $this->host,
            $this->password
            ) = unserialize($serialized , ['allowed_classes']);
    }
}
