<?php

namespace App\Entity\Mysql;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColumnStats
 *
 * @ORM\Table(name="column_stats")
 * @ORM\Entity
 */
class ColumnStats
{
    /**
     * @var string
     *
     * @ORM\Column(name="db_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dbName;

    /**
     * @var string
     *
     * @ORM\Column(name="table_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tableName;

    /**
     * @var string
     *
     * @ORM\Column(name="column_name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $columnName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="min_value", type="string", length=255, nullable=true)
     */
    private $minValue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="max_value", type="string", length=255, nullable=true)
     */
    private $maxValue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nulls_ratio", type="decimal", precision=12, scale=4, nullable=true)
     */
    private $nullsRatio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avg_length", type="decimal", precision=12, scale=4, nullable=true)
     */
    private $avgLength;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avg_frequency", type="decimal", precision=12, scale=4, nullable=true)
     */
    private $avgFrequency;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="hist_size", type="boolean", nullable=true)
     */
    private $histSize;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hist_type", type="string", length=0, nullable=true)
     */
    private $histType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="histogram", type="string", length=255, nullable=true)
     */
    private $histogram;

    public function getDbName(): ?string
    {
        return $this->dbName;
    }

    public function getTableName(): ?string
    {
        return $this->tableName;
    }

    public function getColumnName(): ?string
    {
        return $this->columnName;
    }

    public function getMinValue(): ?string
    {
        return $this->minValue;
    }

    public function setMinValue(?string $minValue): self
    {
        $this->minValue = $minValue;

        return $this;
    }

    public function getMaxValue(): ?string
    {
        return $this->maxValue;
    }

    public function setMaxValue(?string $maxValue): self
    {
        $this->maxValue = $maxValue;

        return $this;
    }

    public function getNullsRatio(): ?string
    {
        return $this->nullsRatio;
    }

    public function setNullsRatio(?string $nullsRatio): self
    {
        $this->nullsRatio = $nullsRatio;

        return $this;
    }

    public function getAvgLength(): ?string
    {
        return $this->avgLength;
    }

    public function setAvgLength(?string $avgLength): self
    {
        $this->avgLength = $avgLength;

        return $this;
    }

    public function getAvgFrequency(): ?string
    {
        return $this->avgFrequency;
    }

    public function setAvgFrequency(?string $avgFrequency): self
    {
        $this->avgFrequency = $avgFrequency;

        return $this;
    }

    public function getHistSize(): ?bool
    {
        return $this->histSize;
    }

    public function setHistSize(?bool $histSize): self
    {
        $this->histSize = $histSize;

        return $this;
    }

    public function getHistType(): ?string
    {
        return $this->histType;
    }

    public function setHistType(?string $histType): self
    {
        $this->histType = $histType;

        return $this;
    }

    public function getHistogram(): ?string
    {
        return $this->histogram;
    }

    public function setHistogram(?string $histogram): self
    {
        $this->histogram = $histogram;

        return $this;
    }


}
