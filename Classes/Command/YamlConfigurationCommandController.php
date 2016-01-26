<?php
namespace MaxServ\YamlConfiguration\Command;

/**
 *  Copyright notice
 *
 *  ⓒ 2016 Michiel Roos <michiel@maxserv.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is free
 *  software; you can redistribute it and/or modify it under the terms of the
 *  GNU General Public License as published by the Free Software Foundation;
 *  either version 2 of the License, or (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful, but
 *  WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 *  or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
 *  more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 */

use Symfony\Component\Yaml\Yaml;
use TYPO3\CMS\Core\Package\PackageInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * Generate TSConfig configuration files from a YAML configuration
 *
 * @package MaxServ\YamlConfiguration
 * @subpackage Controller
 */
class YamlConfigurationCommandController extends AbstractCommandController
{
    /**
     * Relative path to the Yaml Configuration directory
     *
     * @var string
     */
    const CONFIGURATION_DIRECTORY = 'Configuration/';

    /**
     * Condition Class prefix
     *
     * @var string
     */
    const CONDITION_PREFIX = 'MaxServ\YamlConfiguration\User\Condition::';

    /**
     * @var \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected $databaseConnection;

    /**
     * Cache of table column names
     *
     * @var array
     */
    protected $tableColumnCache = array();

    /**
     * YamlConfigurationCommandController constructor.
     */
    public function __construct()
    {
        $this->databaseConnection = $GLOBALS['TYPO3_DB'];
    }

    /**
     * Dump be_groups table to yml file
     *
     * @param array $skipColumns A comma separated list of column names to skip. Default: uc,crdate,lastlogin,tstamp
     * @param bool $includeDeleted Dump deleted records. Default: false
     * @param bool $includeHidden Dump hidden/disable records. Default: false
     */
    public function dumpBackendGroupsCommand(
        $skipColumns = array('crdate', 'lastlogin', 'tstamp', 'uc'),
        $includeDeleted = false,
        $includeHidden = false
    ) {
        $this->headerMessage('Dumping group configuration');
        $yaml = $this->dumpTable('be_groups', $skipColumns, $includeDeleted, $includeHidden);
        if ($yaml !== '') {
            $filePath = PATH_site . 'typo3temp/tx_yamlconfiguration/permissions_be_groups.yml';
            GeneralUtility::writeFile(
                $filePath,
                (string)$yaml
            );
            $this->message('Wrote configuration to: ' . $this->warningString(str_replace(PATH_site, '', $filePath)));
            $this->message('You may want to tidy the output using a tool like: ' . $this->successString('http://www.yamllint.com/'));
        } else {
            $this->warningMessage('No records found.');
        }
    }

    /**
     * Dump be_users table to yml file
     *
     * @param array $skipColumns A comma separated list of column names to skip. Default: uc,crdate,lastlogin,tstamp
     * @param bool $includeDeleted Dump deleted records. Default: false
     * @param bool $includeHidden Dump hidden/disable records. Default: false
     */
    public function dumpBackendUsersCommand(
        $skipColumns = array('crdate', 'lastlogin', 'tstamp', 'uc'),
        $includeDeleted = false,
        $includeHidden = false
    ) {
        $this->headerMessage('Dumping group configuration');
        $yaml = $this->dumpTable('be_users', $skipColumns, $includeDeleted, $includeHidden);
        if ($yaml !== '') {
            $filePath = PATH_site . 'typo3temp/tx_yamlconfiguration/permissions_be_users.yml';
            GeneralUtility::writeFile(
                $filePath,
                (string)$yaml
            );
            $this->message('Wrote configuration to: ' . $this->warningString(str_replace(PATH_site, '', $filePath)));
            $this->message('You may want to tidy the output using a tool like: ' . $this->successString('http://www.yamllint.com/'));
        } else {
            $this->warningMessage('No records found.');
        }
    }

    /**
     * Dump fe_groups table to yml file
     *
     * @param array $skipColumns A comma separated list of column names to skip. Default: uc,crdate,lastlogin,tstamp
     * @param bool $includeDeleted Dump deleted records. Default: false
     * @param bool $includeHidden Dump hidden/disable records. Default: false
     */
    public function dumpFrontendGroupsCommand(
        $skipColumns = array('crdate', 'lastlogin', 'tstamp', 'uc'),
        $includeDeleted = false,
        $includeHidden = false
    ) {
        $this->headerMessage('Dumping group configuration');
        $yaml = $this->dumpTable('fe_groups', $skipColumns, $includeDeleted, $includeHidden);
        if ($yaml !== '') {
            $filePath = PATH_site . 'typo3temp/tx_yamlconfiguration/permissions_fe_groups.yml';
            GeneralUtility::writeFile(
                $filePath,
                (string)$yaml
            );
            $this->message('Wrote configuration to: ' . $this->warningString(str_replace(PATH_site, '', $filePath)));
            $this->message('You may want to tidy the output using a tool like: ' . $this->successString('http://www.yamllint.com/'));
        } else {
            $this->warningMessage('No records found.');
        }
    }

    /**
     * Dump fe_users table to yml file
     *
     * @param array $skipColumns A comma separated list of column names to skip. Default: uc,crdate,lastlogin,tstamp
     * @param bool $includeDeleted Dump deleted records. Default: false
     * @param bool $includeHidden Dump hidden/disable records. Default: false
     */
    public function dumpFrontendUsersCommand(
        $skipColumns = array('crdate', 'lastlogin', 'tstamp', 'uc'),
        $includeDeleted = false,
        $includeHidden = false
    ) {
        $this->headerMessage('Dumping group configuration');
        $yaml = $this->dumpTable('fe_users', $skipColumns, $includeDeleted, $includeHidden);
        if ($yaml !== '') {
            $filePath = PATH_site . 'typo3temp/tx_yamlconfiguration/permissions_fe_users.yml';
            GeneralUtility::writeFile(
                $filePath,
                (string)$yaml
            );
            $this->message('Wrote configuration to: ' . $this->warningString(str_replace(PATH_site, '', $filePath)));
            $this->message('You may want to tidy the output using a tool like: ' . $this->successString('http://www.yamllint.com/'));
        } else {
            $this->warningMessage('No records found.');
        }
    }

    /**
     * Generate TSConfig configuration files from a YAML configuration
     * \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig
     *
     * @return void
     */
    public function generateTsConfigCommand()
    {
        $this->headerMessage('Generating permssions');
        foreach ($this->findYamlFiles() as $configurationFile) {
            $configuration = $this->parseConfigurationFile($configurationFile);

            $this->infoMessage('Parsing: ' . str_replace(PATH_site, '', $configurationFile));
            $forms = $this->getFormConfiguration($configuration);
            foreach ($forms as $table => $ruleSets) {
                foreach ($ruleSets as $key => $ruleSet) {
                    $lines = array();
                    $hasCondition = false;
                    if (isset($ruleSet['title'])) {
                        $lines[] = '';
                        $lines[] = "// " . $ruleSet['title'];
                    }
                    if (isset($ruleSet['description'])) {
                        $lines[] = "// ";
                        $lines[] = "// " . $ruleSet['description'];
                        $lines[] = '';
                    }
                    if (!in_array($key, $this->getColumnNames($table))
                        && isset($ruleSet['userFunctions'])
                    ) {
                        $conditionLineParts = array();
                        $operator = ($ruleSet['operator']) ?: '&&';
                        foreach ($ruleSet['userFunctions'] as $userFunction) {
                            $conditionLineParts[] = '[userFunc = ' . self::CONDITION_PREFIX . $userFunction . ']';
                        }
                        if (count($conditionLineParts)) {
                            $hasCondition = true;
                            $lines[] = implode(' ' . $operator . ' ', $conditionLineParts);
                        }
                    }
                    $lines[] = "TCEFORM {";
                    $lines[] = "\t" . $table . ' {';
                    if (isset($ruleSet['contentElements'])) {
                        $lines[] = "\t\tCType.keepItems := addToList(" . implode(', ',
                                $ruleSet['contentElements']) . ')';
                    }
                    if (isset($ruleSet['plugins'])) {
                        $lines[] = "\t\tlist_type.keepItems := addToList(" . implode(', ',
                                $ruleSet['plugins']) . ')';
                    }
                    $lines[] = "\t}";
                    $lines[] = "}";
                    $lines[] = "mod.wizards.newContentElement.wizardItems {";
                    if (isset($ruleSet['contentElements'])) {
                        $lines[] = "\tcommon.show := addToList(" . implode(', ',
                                $ruleSet['contentElements']) . ')';
                    }
                    if (isset($ruleSet['plugins'])) {
                        $lines[] = "\tplugins.show := addToList(" . implode(', ',
                                $ruleSet['plugins']) . ')';
                    }
                    $lines[] = "}";
                    if ($hasCondition) {
                        $lines[] = '[global]';
                    }
                    $fileContent = implode(PHP_EOL, $lines);
                    $filePath = PATH_site . 'typo3temp/tx_yamlconfiguration/' . $key . '.ts';
                    GeneralUtility::writeFile(
                        $filePath,
                        (string)$fileContent
                    );
                    $this->message('Wrote configuration to: ' . str_replace(PATH_site,
                            '', $filePath));
                }
            }
        }
    }

    /**
     * Dump table table to yml file
     *
     * @param string $table
     * @param array $skipColumns
     * @param bool $includeDeleted Dump deleted records. Default: false
     * @param bool $includeHidden Dump hidden/disable records. Default: false
     *
     * @return string
     */
    public function dumpTable(
        $table,
        $skipColumns = array('crdate', 'lastlogin', 'tstamp', 'uc'),
        $includeDeleted = false,
        $includeHidden = false
    ) {
        $yaml = '';
        $table = preg_replace('/[^a-z0-9_]/', '', $table);
        $columnNames = $this->getColumnNames($table);
        $where = '1 = 1';
        if (!$includeHidden || !$includeDeleted) {
            $where = array();
            if (!$includeHidden) {
                if (in_array('disable', $columnNames)) {
                    $where[] = 'disable = 0';
                }
                if (in_array('hidden', $columnNames)) {
                    $where[] = 'hidden = 0';
                }
            }
            if (!$includeDeleted) {
                $where[] = 'deleted = 0';
            }
            $where = implode(' AND ', $where);
        }
        $result = $this->databaseConnection->exec_SELECTgetRows('*', $table, $where);
        if ($result) {
            $explodedResult = array();
            foreach ($result as $row) {
                $explodedRow = array();
                foreach ($row as $column => $value) {
                    if (in_array($column, $skipColumns)) {
                        continue;
                    }
                    $explodedValue = explode(',', $value);
                    if (count($explodedValue) > 1) {
                        $explodedRow[$column] = $explodedValue;
                    } elseif ($value) {
                        $explodedRow[$column] = $value;
                    }
                }
                $explodedResult[] = $explodedRow;
            }
            $dump = array(
                'TYPO3' => array(
                    'Access' => array(
                        $table => $explodedResult
                    )
                )
            );
            $yaml = Yaml::dump($dump);
        }

        return $yaml;
    }

    /**
     * Get column names
     *
     * @param $table
     *
     * @return array
     */
    protected function getColumnNames($table)
    {
        $table = preg_replace('/[^a-z0-9_]/', '', $table);
        if (isset($this->tableColumnCache[$table])) {
            return $this->tableColumnCache[$table];
        } else {
            $result = $this->databaseConnection->exec_SELECTgetSingleRow(
                '*',
                $table,
                '1 = 1'
            );
            if ($result) {
                $columnNames = array_keys($result);
                $this->tableColumnCache[$table] = $columnNames;
            } else {
                $columnNames = array();
                $result = $this->databaseConnection->sql_query('SELECT DATABASE();');
                $row = $this->databaseConnection->sql_fetch_row($result);
                $databaseName = $row[0];
                $this->databaseConnection->sql_free_result($result);
                $result = $this->databaseConnection->sql_query(
                    "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" .
                    $databaseName .
                    "' AND TABLE_NAME = '" .
                    $table .
                    "';"
                );
                while (($row = $this->databaseConnection->sql_fetch_row($result))) {
                    $columnNames[] = $row[0];
                };
                $this->databaseConnection->sql_free_result($result);
                $this->tableColumnCache[$table] = $columnNames;
            }

            return $columnNames;
        }
    }

    /**
     * Find YAML configuration files in all active extensions
     *
     * @return array
     */
    protected function findYamlFiles()
    {
        /** @var \TYPO3\CMS\Core\Package\PackageManager $packageManager */
        $packageManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Package\\PackageManager');
        $activePackages = $packageManager->getActivePackages();

        $configurationFiles = array();
        foreach ($activePackages as $package) {
//            if ($package->getPackageKey() === 'yaml-configuration') {
//                continue;
//            }
            if (!($package instanceof PackageInterface)) {
                continue;
            }
            $packagePath = $package->getPackagePath();
            if (!is_dir($packagePath . self::CONFIGURATION_DIRECTORY)) {
                continue;
            }
            $configurationFiles = array_merge(
                $configurationFiles,
                GeneralUtility::getFilesInDir(
                    $packagePath . self::CONFIGURATION_DIRECTORY,
                    'yaml,yml',
                    true
                )
            );
        }

        return $configurationFiles;
    }

    /**
     * Check if the configuration file exists and if the Yaml parser is
     * available
     *
     * @param $configurationFile
     *
     * @return array|null
     */
    protected function parseConfigurationFile($configurationFile)
    {
        $configuration = null;
        if (!empty($configurationFile)
            && is_file($configurationFile)
            && is_callable(array(
                'Symfony\\Component\\Yaml\\Yaml',
                'parse'
            ))
        ) {
            $configuration = Yaml::parse(file_get_contents($configurationFile));
        }

        return $configuration;
    }

    /**
     * Get TCEFORM configuration from configuration string
     *
     * @param $configuration
     *
     * @return array
     */
    protected function getFormConfiguration($configuration)
    {
        $ruleSets = array();
        if ($configuration !== null && count($configuration) === 1) {
            if (isset($configuration['TYPO3']['TSConfig']['TCEFORM'])
                && is_array($configuration['TYPO3']['TSConfig']['TCEFORM'])
            ) {
                $ruleSets = $configuration['TYPO3']['TSConfig']['TCEFORM'];
            }
        }

        return $ruleSets;
    }
}
