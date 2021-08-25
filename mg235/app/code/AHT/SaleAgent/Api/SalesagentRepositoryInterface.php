<?php
namespace AHT\SaleAgent\Api;

interface SalesagentRepositoryInterface
{
    /**
     * Save block.
     *
     * @param \AHT\Salesagents\Api\Data\SalesagentInterface $salesagent
     * @return \AHT\Salesagents\Api\Data\SalesagentInterface
     */
    public function save(\AHT\SaleAgent\Api\Data\SalesagentInterface $salesagent);

    /**
     * Retrieve block.
     *
     * @param int $salesagentId
     * @return \AHT\Salesagents\Api\Data\SalesagentInterface
     */
    public function getById($blockId);

    /**
     * Delete block.
     *
     * @param \AHT\Salesagents\Api\Data\SalesagentInterface $salesagents
     * @return \AHT\Salesagents\Api\Data\SalesagentInterface
     */
    public function delete(\AHT\SaleAgent\Api\Data\SalesagentInterface $salesagent);

    /**
     * Delete block by ID.
     *
     * @param  int $salesagentsId
     * @return \AHT\Salesagents\Api\Data\SalesagentInterface
     */
    public function deleteById($blockId);
}
