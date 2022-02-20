import React from "react";

const CampaignCreatives = (props) => {
    const { creativeUploads } = props;
    return _.isArray(creativeUploads) ? (
        <div className="row">
            <div className="col-md12">
                <h3>Creatives</h3>
            </div>
            {creativeUploads.map((element, index) => (
                <div
                    key={index}
                    className="col-md-4 mb-3"
                    id={"campaign_creative_img_" + element.id}
                >
                    <img
                        src={element.path}
                        className="img-fluid"
                        alt={element.file_name}
                    />
                </div>
            ))}
        </div>
    ) : (
        ""
    );
};

export default CampaignCreatives;
