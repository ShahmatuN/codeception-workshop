<?php

require_once 'vendor/codeception/codeception/autoload.php';

class RoboFile extends \Robo\Tasks
{
    use Codeception\Task\Merger\ReportMerger;
    use Codeception\Task\Splitter\TestsSplitterTrait;

    const STREAM = 1;

    public function parallelSplitTests($suite): void
    {
        $result = $this->taskSplitTestsByGroups(5)
            ->testsFrom('tests/' . $suite)
            ->projectRoot('.')
            ->groupsTo('tests/_groups/' . $suite . '_')
            ->run();
    }

    public function parallelRun($suite, $args = null)
    {
        $parallel = $this->taskParallelExec();
        for ($i = 1; $i <= self::STREAM; $i++) {
            $parallel->process(
                $this->taskCodecept()
                    ->suite($suite)
                    ->group($suite . '_' . $i)
                    ->args(explode(' ', $args))
                    ->html($suite . '_result_' . $i . '.html')
            );
        }
        return $parallel->run();
    }

    public function parallelMergeResults($suite, $logType): void
    {
        $merge = null;
        if ($logType === 'html') {
            $merge = $this->taskMergeHTMLReports();
        } elseif ($logType === 'xml') {
            $merge = $this->taskMergexmlReports();
        }
        for ($i = 1; $i <= self::STREAM; $i++) {
            $merge->from('tests/_output/' . $suite . '_result_' . $i . '.' . $logType);
        }
        $merge->into('tests/_output/' . $suite . '_result.' . $logType)->run();
    }

    public function parallelSuite($suite = 'Acceptance', $args = null)
    {
        $this->parallelSplitTests($suite);
        $result = $this->parallelRun($suite, $args);
        $this->parallelMergeResults($suite, 'html');
        return $result;
    }
}
