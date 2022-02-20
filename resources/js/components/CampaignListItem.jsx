import React, { useState } from "react";
import Modal from "react-bootstrap/Modal";

const CampaignListItem = (props) => {
    const { campaign } = props;
    const [showModal, setShowModal] = useState(false);

    const handleClose = () => setShowModal(false);
    const handleShow = () => setShowModal(true);

    return (
        <tr>
            <th scope="row">{campaign.id}</th>
            <td>{campaign.name}</td>
            <td>{campaign.start_date}</td>
            <td>{campaign.end_date}</td>
            <td>${campaign.daily_budget}</td>
            <td>${campaign.total_budget}</td>
            <td>
                <a
                    href="#"
                    onClick={handleShow}
                    className="btn btn-sm btn-outline-success me-2"
                >
                    Preview
                </a>
                <a
                    href={`/campaigns/${campaign.id}/edit`}
                    className="btn btn-sm btn-outline-primary me-2"
                >
                    Edit
                </a>
            </td>
            <Modal size="lg" show={showModal} onHide={handleClose}>
                <Modal.Header closeButton>
                    <Modal.Title>{campaign.name}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div className="row">
                        {campaign.creative_upload.map((element, index) => (
                            <div
                                key={index}
                                className="col-md-4 mb-3"
                                id={"campaign_creative_img_" + index}
                            >
                                <img
                                    src={element.path}
                                    className="img-fluid"
                                    alt={element.file_name}
                                />
                            </div>
                        ))}
                    </div>
                </Modal.Body>
            </Modal>
        </tr>
    );
};

export default CampaignListItem;
