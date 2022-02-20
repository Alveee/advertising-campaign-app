import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import CampaignListItem from "./CampaignListItem";

const CampaignList = (props) => {
    const [campaigns, setCampaigns] = useState([]);
    const getCampaigns = () => {
        axios
            .get("/api/v1/campaigns")
            .then((res) => {
                setCampaigns(res.data.data);
            })
            .catch((err) => {
                console.log(err);
            });
    };
    useEffect(() => {
        getCampaigns();
    }, []);
    return (
        <div className="table-responsive">
            <table className="table table-light table-bordered table-striped table-hover">
                <thead>
                    <tr className="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Daily Budget</th>
                        <th scope="col">Total Budget</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {campaigns.length &&
                        campaigns.map((campaign) => (
                            <CampaignListItem
                                key={campaign.id}
                                campaign={campaign}
                            ></CampaignListItem>
                        ))}
                </tbody>
            </table>
        </div>
    );
};

export default CampaignList;

if (document.getElementById("campaign-list")) {
    ReactDOM.render(<CampaignList />, document.getElementById("campaign-list"));
}
