<?php
/****************************
 * Contract method calls   *
 ****************************/

$contract_handler = new Connect\Contract;
$assetCount = $contract_handler->getContractCount();
$assetPendingCount = $contract_handler->getAssetPendingCount();
$assetPendingChecksCount = $contract_handler->getAssetPendingChecksCount();
$assetPendingDocumentUploadCount = $contract_handler->getAssetPendingDocumentUploadCount();
$assetCompletedCount = $contract_handler->getAssetCompletedCount();
$userAssociationCount = $contract_handler->getUserAssociationCount();

if (!empty($assetCount['count'])) {
    $assetOutstandingCount = $assetCount['count'] - $assetCompletedCount['count'];
    $assetOutstandingPercent = ($assetOutstandingCount / $assetCount['count']) * 100;
    $assetCompletedPercent = ($assetCompletedCount['count'] / $assetCount['count']) * 100;
} else {
    $assetOutstandingCount = 0;
    $assetOutstandingPercent = 0;
    $assetCompletedPercent = 0;
}


$user_handler = new Connect\UserHandler;
$customerCount = $user_handler->getClientCount('customer');
$intermediaryCount = $user_handler->getClientCount('intermediary');